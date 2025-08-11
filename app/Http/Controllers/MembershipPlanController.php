<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use App\Http\Requests\MembershipPlan\StoreRequest;
use App\Http\Requests\MembershipPlan\UpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class MembershipPlanController extends Controller
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
        $plansQuery = MembershipPlan::where('name', 'LIKE', '%' . $search . '%')->where('type', 'NORMAL');

        // Paginate the results based on the provided limit
        $plans = $plansQuery->paginate($limit);

        // Return the view with plans, search term, and limit for display
        return view('admin.membership-plans.index', compact('plans', 'search', 'limit'));
    }

    /**
     * Display the form for creating a new membership plan.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.membership-plans.create');
    }

    /**
     * Store a newly created membership plan in storage.
     *
     * @param  \App\Http\Requests\MembershipPlan\StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        // Create a new MembershipPlan instance from validated request data
        MembershipPlan::create($request->validated());

        // Redirect back to the index page with a success message
        return redirect()->route('membership-plans.index')->with('success', 'Membership Plan created successfully!');
    }

    /**
     * Display the form for editing a membership plan.
     *
     * @param  \App\Models\MembershipPlan $plan
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(MembershipPlan $plan): View
    {
        // Return the edit view with the found membership plan
        return view('admin.membership-plans.edit', compact('plan'));
    }

    /**
     * Update the specified membership plan in storage.
     *
     * @param  \App\Http\Requests\MembershipPlan\UpdateRequest $request
     * @param  \App\Models\MembershipPlan $plan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, MembershipPlan $plan): RedirectResponse
    {
        // Update the membership plan with the validated request data
        $plan->update($request->validated());

        // Redirect back to the index page with a success message
        return redirect()->route('membership-plans.index')->with('success', 'Membership Plan updated successfully!');
    }

    /**
     * Display the specified membership plan.
     *
     * @param  \App\Models\MembershipPlan $plan
     * @return \Illuminate\Contracts\View\View
     */
    public function show(MembershipPlan $plan): View
    {
        // Return the view showing the specified membership plan
        return view('admin.membership-plans.show', compact('plan'));
    }

    /**
     * Remove the specified membership plan from storage.
     *
     * @param  \App\Models\MembershipPlan $plan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MembershipPlan $plan): RedirectResponse
    {
        // Delete the membership plan
        $plan->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('membership-plans.index')->with('success', 'Membership Plan deleted successfully!');
    }
}
