<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipPlan;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PersonalTrainingController extends Controller 
{

    /**
     * Display a paginated list of membership plans.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): View
    {
        // Retrieve search query and limit from request parameters
        $search = $request->get('search', '');
        $limit = $request->get('limit', 100); // Default limit set to 100

        // Query membership plans based on search criteria
        $plansQuery = MembershipPlan::where('name', 'LIKE', '%' . $search . '%')->where('type', 'PERSONAL_TRAINING');

        // Paginate the results based on the provided limit
        $plans = $plansQuery->paginate($limit);

        return view('admin.personal-training.index', compact('plans', 'search', 'limit'));
    }

    /**
     * Display a listing of members with a membership plan type "PERSONAL_TRAINING" with optional search and pagination.
     *
     * @param \Illuminate\Http\Request $request The request instance containing search and limit parameters.
     *
     * @return \Illuminate\View\View The view displaying the list of members.
     */
    public function members(Request $request): View
    {
        // Retrieve the search query from the request, default to an empty string if not provided
        $search = $request->get('search', '');

        // Retrieve the pagination limit from the request, default to 100 if not provided
        $limit  = $request->get('limit', '100');

        // Fetch members from the database who have a membership plan of type "PERSONAL_TRAINING"
        $members = Member::with('membershipPlan')->whereHas('membershipPlan', function ($query) {
            $query->where('type', 'PERSONAL_TRAINING');
        })->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('member_id', 'LIKE', '%' . $search . '%')
                ->orWhere('contact_number', 'LIKE', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->paginate($limit);

        // Return the 'admin.personal-training.members' view with the members, search, and limit variables.
        return view('admin.personal-training.members', compact('members', 'search', 'limit'));
    }


    public function create()
    {
        return view('admin.personal-training.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules(), $this->validationMessage());
        $request['type'] = "PERSONAL_TRAINING";

        $plan = MembershipPlan::create($request->all());
        $plan->save();

        return redirect()->route('personal-training.index')->with('success', 'Personal training profile has been successfully created!');
    }

    public function edit($id)
    {
        $plan = MembershipPlan::findOrFail($id);
        return view('admin.personal-training.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validationRules(), $this->validationMessage());

        $plan = MembershipPlan::findOrFail($id);
        $plan->update($request->all());
        return redirect()->route('personal-training.index')->with('success', 'Training details updated successfully.');
    }

    public function show($id)
    {
        $plan = MembershipPlan::findOrFail($id);
        return view('admin.personal-training.show', compact('plan'));
    }

    public function destroy($id)
    {
        $plan = MembershipPlan::findOrFail($id);
        $plan->delete();
        return redirect()->route('personal-training.index')->with('success', 'Training record deleted successfully!');
    }

    protected function validationRules()
    {
        return array(
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0',
            'validity' => 'required|integer|min:1',
            'details' => 'nullable|string',
        );
    }

    protected function validationMessage()
    {
        return array(
            'name.required' => 'The name field is required.',
            'rate.required' => 'The rate field is required.',
            'rate.numeric' => 'The rate must be a number.',
            'rate.min' => 'The rate must be at least :min.',
            'validity.required' => 'The validity field is required.',
            'validity.integer' => 'The validity must be an integer.',
            'validity.min' => 'The validity must be at least :min.',
            'details.string' => 'The details must be a string.',
        );
    }
}
