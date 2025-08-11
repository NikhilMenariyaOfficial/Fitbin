<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Payment;
use App\Models\MembershipPlan;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Illuminate\Validation\ValidationException;

use App\Exports\MembersExport;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{

    /**
     * Display a listing of members with optional search and pagination.
     * Also fetch associated membership plans with type "NORMAL".
     *
     * @param \Illuminate\Http\Request $request The request instance containing search and limit parameters.
     *
     * @return \Illuminate\View\View The view displaying the list of members.
     */
    public function index(Request $request): View
    {
        // Retrieve the search query from the request, default to an empty string if not provided
        $search = $request->get('search', '');

        // Retrieve the pagination limit from the request, default to 100 if not provided
        $limit  = $request->get('limit', '100');

        // Fetch members from the database who have a membership plan of type "NORMAL"
        $members = Member::with('membershipPlan')->whereHas('membershipPlan', function ($query) {
            $query->where('type', 'NORMAL');
        })->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('member_id', 'LIKE', '%' . $search . '%')
                ->orWhere('contact_number', 'LIKE', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->paginate($limit);

        // Return the 'admin.members.index' view with the members, search, and limit variables.
        return view('admin.members.index', compact('members', 'search', 'limit'));
    }


    public function create()
    {
        $membershipPlans = MembershipPlan::all();
        return view('admin.members.create', compact('membershipPlans'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate($this->validationRules($request), $this->validationMessages($request));

            $membershipPlan = MembershipPlan::findOrFail($request->membership_plan_id);

            $payload = (object) $request->all();

            $payload->membership_start_date = $payload->joining_date;
            $payload->membership_end_date   = Carbon::parse($payload->joining_date)->addDays($membershipPlan->validity);
            $payload->membership_fee = (float) $membershipPlan->rate;
            $payload->amount_paid    = $request->amount;
            $payload->pending_amount = (float) ($membershipPlan->rate - $request->amount);
            $payload->last_payment_date = now();

            DB::beginTransaction();

            $member = new Member((array) $payload);
            $member->save();

            $payment = new Payment();
            $payment->member_id = $member->id;
            $payment->membership_plan_id = $member->membership_plan_id;
            $payment->amount    = $member->amount;
            $payment->payment_date = now();
            $payment->save();

            DB::commit();

            return redirect()->route('members.index')->with('success', 'Member created successfully');
        } catch (ValidationException $error) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors($error->errors())
                ->with('error', 'Validation failed. Please make sure you have selected a valid status.');
        } catch (\Exception $error) {
            DB::rollBack();
            $errorMessage = app()->environment('production') ?
                'An unexpected error occurred. Please try again later.' :
                'Error: ' . $error->getMessage();
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    public function show($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.show', compact('member'));
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $membershipPlans = MembershipPlan::all();
        return view('admin.members.edit', compact('member', 'membershipPlans'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate($this->validationRules($request), $this->validationMessages($request));

            $member = Member::findOrFail($id);
            $member->update($request->all());

            return redirect()->route('members.index')->with('success', 'Member updated successfully');
        } catch (ValidationException $error) {
            return redirect()->back()->withInput()->withErrors($error->errors())
                ->with('error', 'Validation failed. Please make sure you have selected a valid status.');
        } catch (ModelNotFoundException $error) {
            return redirect()->back()->with('error', 'Member not found.');
        } catch (\Exception $error) {
            $errorMessage = app()->environment('production') ?
                'An unexpected error occurred while updating the member. Please try again.' :
                'Error: ' . $error->getMessage();
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully');
    }

    public function membershipRenew(Request $request, $memberId)
    {
        $member = Member::findOrFail($memberId);
        $membershipPlans = MembershipPlan::all();

        return view('admin.members.membership-renew', compact('member', 'membershipPlans'));
    }

    public function membershipRenewStore(Request $request, $memberId)
    {
        try {

            $request->validate([
                'renewal_date' => 'required|date',
                'amount' => 'required|numeric',
                'membership_plan_id' => 'required|exists:membership_plans,id',
            ], [
                'amount.required' => 'The payment amount is required.',
                'amount.numeric' => 'The payment amount must be a number.',
                'membership_plan_id.required' => 'You must select a valid membership plan.',
                'membership_plan_id.exists' => 'The selected membership plan does not exist.',
                'renewal_date.required' => 'The renewal date is required.',
                'renewal_date.date' => 'The renewal date must be a valid date in the format YYYY-MM-DD.',
            ]);

            $member = Member::findOrFail($memberId);
            $membershipPlan = MembershipPlan::findOrFail($request->membership_plan_id);

            DB::beginTransaction();

            $member->membership_plan_id    = $request->membership_plan_id;
            $member->membership_start_date = $request->renewal_date;
            $member->membership_end_date   = Carbon::parse($request->renewal_date)->addDays($membershipPlan->validity);
            $member->membership_fee = (float) $membershipPlan->rate;
            $member->amount_paid    = $request->amount;
            $member->pending_amount = (float) ($membershipPlan->rate - $request->amount);
            $member->last_payment_date = now();
            $member->save();

            $payment = new Payment();
            $payment->member_id = $member->id;
            $payment->membership_plan_id = $member->membership_plan_id;
            $payment->amount    = $request->amount;
            $payment->payment_date = now();
            $payment->save();

            DB::commit();

            $successMessage = $this->membershipRenewMessages($member, $request);

            return redirect()->route('members.index')->with('success', $successMessage);
        } catch (ValidationException $error) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors($error->errors())
                ->with('error', 'Validation failed. Please make sure you have selected a valid status.');
        } catch (\Exception $error) {
            DB::rollBack();
            $errorMessage = app()->environment('production') ?
                'Failed to renew membership due to an unexpected error.' :
                'Error: ' . $error->getMessage();
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    public function membershipPayment(Request $request, $memberId)
    {
        $member = Member::findOrFail($memberId);
        $membershipPlans = MembershipPlan::all();

        return view('admin.members.membership-payment', compact('member', 'membershipPlans'));
    }

    public function membershipPaymentStore(Request $request, $memberId)
    {

        $request->validate([
            'amount'        => 'required|numeric',
            'membership_plan_id' => 'required|exists:membership_plans,id',
        ]);

        $member = Member::findOrFail($memberId);

        DB::beginTransaction();

        $member->amount_paid    += (float) ($request->amount);
        $member->pending_amount -= (float) ($request->amount);
        $member->last_payment_date = now();
        $member->save();

        $payment = new Payment();
        $payment->member_id = $member->id;
        $payment->membership_plan_id = $member->membership_plan_id;
        $payment->amount    = $request->amount;
        $payment->payment_date = now();
        $payment->save();

        DB::commit();

        $successMessage = $this->membershipPaymentMessage($member, $request);

        return redirect()->route('alert.unpaid-members')->with('success', $successMessage);
    }

    protected function validationRules($request)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'address' => 'nullable',
            'email' => 'nullable|email|unique:members,email,' . request()->route('id'),
            'height' => 'required|numeric|between:0.01,999.99',
            'weight' => 'required|numeric|between:0.01,999.99',
            'contact_number' => 'required|regex:/^[0-9]{10}$/',
            'joining_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_personal_training' => 'nullable|in:YES,NO',

        );

        if ($request->isMethod('post')) {
            $rules['joining_date'] = 'required|date';
            $rules['membership_plan_id'] = 'required';
            $rules['is_personal_training'] = ' required|in:YES,NO';
            $rules['amount'] = 'required|numeric|min:0';
        }

        return $rules;
    }

    protected function validationMessages()
    {
        return array(
            'name.required' => 'Please provide the name.',
            'name.max' => 'The name must not exceed 255 characters.',
            'membership_plan_id.required' => 'Please specify the plan.',
            'proof_given.required' => 'Please provide the given proof.',
            'gender.required' => 'Please specify the gender.',
            'gender.max' => 'The gender must not exceed 255 characters.',
            'age.required' => 'Please provide the age.',
            'age.integer' => 'The age must be a valid integer.',
            'age.min' => 'The age must be at least 0.',
            'address.required' => 'Please provide the address.',
            'email.required' => 'Please provide an email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'height.required' => 'Please provide the height.',
            'height.numeric' => 'The height must be a valid number.',
            'height.min' => 'The height must be at least 0.',
            'weight.required' => 'Please provide the weight.',
            'weight.numeric' => 'The weight must be a valid number.',
            'weight.min' => 'The weight must be at least 0.',
            'amount.required' => 'Please provide the amount.',
            'amount.numeric' => 'The amount must be a valid number.',
            'amount.min' => 'The amount must be at least 0.',
            'contact_number.required' => 'Please provide the contact number.',
            'contact_number.max' => 'The contact number must not exceed 20 characters.',
            'image.image' => 'Please upload a valid image file.',
            'image.mimes' => 'The image must be of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image must not be larger than 2048 KB.',
            'contact_number.required' => 'Please provide the contact number.',
            'contact_number.regex' => 'The contact number must be a 10-digit number.',
            'height.between' => 'The height must be between 0 and 999.99.',
            'weight.between' => 'The weight must be between 0 and 999.99.',
            'joining_date.required' => 'The joining date is required.',
            'joining_date.date' => 'The joining date must be a valid date.',
            'is_personal_training.required' => 'The personal training field is required.',
            'is_personal_training.in' => 'The personal training field must be either "YES" or "NO".',
        );
    }

    protected function membershipPaymentMessage($member, $request)
    {
        switch (true) {
            case $member->pending_amount > 0:
                return "Partial payment recorded successfully for $member->name. You paid ₹$member->amount_paid, and ₹$member->pending_amount is still due.";
            case $member->pending_amount == 0:
                return "Full payment recorded successfully for $member->name";
            default:
                return "Payment recorded successfully for $member->name. You paid ₹$request->amount, resulting in an overpayment of ₹ " . abs($request->amount);
        }
    }

    protected function membershipRenewMessages($member, $request)
    {
        switch (true) {
            case $member->pending_amount > 0:
                return $member->name . '\'s membership renewed successfully. Partial payment of ₹' . $member->amount_paid . ' recorded. Remaining due: ₹' . $member->pending_amount;
            case $member->pending_amount === 0:
                return $member->name . '\'s membership renewed successfully. Full payment of ₹' . $member->amount_paid . ' recorded. No remaining amount due.';
            case $member->pending_amount < 0:
                return $member->name . '\'s membership renewed successfully. Overpayment of ₹' . abs($request->amount - $member->membership_fee) . ' recorded.';
            default:
                return $member->name . '\'s membership renewed successfully.';
        }
    }

    public function export()
    {
        return Excel::download(new MembersExport, 'members.xlsx');
    }
}
