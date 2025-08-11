<?php

namespace App\Http\Controllers;

use App\Http\Requests\TermsAndConditions\StoreRequest;
use App\Models\TermsAndConditions;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TermsAndConditionsController extends Controller
{
    /**
     * Display the terms and conditions.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Retrieve the first (and only) terms and conditions record
        $terms = TermsAndConditions::first();

        // Return the admin terms view with the retrieved terms
        return view('admin.terms.index', compact('terms'));
    }

    /**
     * Store or update the terms and conditions.
     *
     * @param  \App\Http\Requests\TermsAndConditions\StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        // Retrieve the first (and only) terms and conditions record or create a new instance
        $terms = TermsAndConditions::firstOrNew();

        // Update the terms and conditions with the request data
        $terms->fill($request->validated())->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Terms and Conditions updated successfully!');
    }

    /**
     * Show the terms and conditions.
     *
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        // Retrieve the first (and only) terms and conditions record
        $terms = TermsAndConditions::first();

        // Return the view to display the terms and conditions
        return view('public.terms-and-conditions.show', compact('terms'));
    }
}
