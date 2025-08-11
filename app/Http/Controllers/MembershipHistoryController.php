<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipHistory\StoreRequest;
use App\Http\Requests\MembershipHistory\UpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\MembershipHistory;
use App\Models\MembershipPlan;
use App\Models\Member;

class MembershipHistoryController extends Controller
{
    public function index(Request $request)
    {
        $limit  = $request->get('limit', '10');

        $histories = MembershipHistory::whereNotNull('id');
        $histories = $histories->orderBy('created_at', 'desc');
        $histories = ($limit == '*') ? $histories->get() : $histories->paginate($limit);

        $paginationAvailable = ($limit == '*') ? FALSE : TRUE;

        return view('admin.membership-histories.index', compact('histories', 'paginationAvailable', 'limit'));
    }

    public function create()
    {
        $membershipPlans = MembershipPlan::all();
        $members = Member::all();
        return view('admin.membership-histories.create', compact('members', 'membershipPlans'));
    }

    public function store(StoreRequest $request)
    {
        try {

            DB::beginTransaction();

            $history = new MembershipHistory($request->validated());
            $history->save();

            DB::commit();

            return redirect()->route('membership-histories.index')->with('success', 'Membership history created successfully.');
        } catch (ValidationException $error) {
            return redirect()->back()->withInput()->withErrors($error->errors())
                ->with('error', 'Validation failed. Please make sure you have selected a valid status.');
        } catch (\Exception $error) {
            $errorMessage = app()->environment('production') ?
                'An unexpected error occurred while processing your request. Please try again.' :
                'An error occurred: ' . $error->getMessage();
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    public function edit($id)
    {
        $membershipHistory = MembershipHistory::findOrFail($id);
        $membershipPlans = MembershipPlan::all();
        $members = Member::all();

        return view('admin.membership-histories.edit', compact('membershipHistory', 'members', 'membershipPlans'));
    }

    public function update(UpdateRequest $request, $id)
    {
        try {

            DB::beginTransaction();

            $membershipHistory = MembershipHistory::findOrFail($id);
            $membershipHistory->update($request->validated());

            DB::commit();

            return redirect()->route('membership-histories.index')->with('success', 'Membership history updated successfully.');
        } catch (ValidationException $error) {
            return redirect()->back()->withInput()->withErrors($error->errors())
                ->with('error', 'Validation failed. Please make sure you have selected a valid status.');
        } catch (ModelNotFoundException $error) {
            DB::rollBack();
            return redirect()->route('membership-histories.index')->with('error', 'Membership history not found.');
        } catch (\Exception $error) {
            DB::rollBack();
            $errorMessage = app()->environment('production') ?
                'An unexpected error occurred while processing your request. Please try again.' :
                'An error occurred: ' . $error->getMessage();
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $membershipHistory = MembershipHistory::findOrFail($id);
            $membershipHistory->delete();

            DB::commit();

            return redirect()->route('membership-histories.index')->with('success', 'Membership history deleted successfully.');
        } catch (ModelNotFoundException $error) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Membership history not found.');
        } catch (\Exception $error) {
            DB::rollBack();
            $errorMessage = app()->environment('production') ?
                'Failed to delete the membership history. Please try again later.' :
                'Error: ' . $error->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }
}
