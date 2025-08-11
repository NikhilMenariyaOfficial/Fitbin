<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipRequest\StoreRequest;

use App\Models\TemporaryMember;
use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\TermsAndConditions;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MembershipRequestController extends Controller
{
    /**
     * Show the registration form for temporary members.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $terms = TermsAndConditions::first();
        $membershipPlans = MembershipPlan::where('type','NORMAL')->get();
        $personalTrainingPlans = MembershipPlan::where('type','PERSONAL_TRAINING')->get();

        return view('public.membership-request.register',compact('membershipPlans','personalTrainingPlans','terms'));
    }

    /**
     * Store a newly created temporary member in storage.
     *
     * @param  \App\Http\Requests\MembershipRequest\StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        // Create a new TemporaryMember instance
        $temporaryMember = new TemporaryMember($request->validated());
        $temporaryMember->save();

        // Redirect to the thank you page after successful registration
        return redirect()->route('member.registration.thankyou')->with('success', 'Registration successful! Please await admin approval.');
    }

    /**
     * Show a thank you page after successful registration.
     *
     * @return \Illuminate\View\View
     */
    public function thankYou(): View
    {
        return view('public.membership-request.thankyou');
    }

    /**
     * Show the pending registrations awaiting admin approval.
     *
     * @return \Illuminate\View\View
     */
    public function showPendingRegistrations(): View
    {
        // Retrieve all pending temporary member registration
        $pendingMembers = TemporaryMember::all();

        // Return view with pending members data
        return view('admin.membership-request.pending-registrations', compact('pendingMembers'));
    }

    /**
     * Approve a temporary member registration and move to main members table.
     *
     * @param \App\Models\TemporaryMember $temporaryMember
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveRegistration(TemporaryMember $temporaryMember): RedirectResponse
    {
        // Create a new Member entry in the main members table
        $member = new Member();
        $member->name = $temporaryMember->name;
        $member->email = $temporaryMember->email;
        $member->gender = $temporaryMember->gender;
        $member->contact_number = $temporaryMember->contact_number;
        $member->save();

        // Delete the temporary registration after approval
        $temporaryMember->delete();

        // Redirect back with success message
        return redirect()->route('membership-request.pending.registrations')->with('success', 'Member registration approved and moved to main members.');
    }

    /**
     * Reject a temporary member registration.
     *
     * @param \App\Models\TemporaryMember $temporaryMember
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectRegistration(TemporaryMember $temporaryMember): RedirectResponse
    {
        // Find the temporary member registration by ID and delete it
        $temporaryMember->delete();

        // Redirect back with success message
        return redirect()->route('membership-request.pending.registrations')->with('success', 'Member registration rejected successfully.');
    }
}
