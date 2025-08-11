<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use App\Models\MembershipPlan;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class EnquiryController extends Controller {

    public function index(Request $request) {
        $search = $request->get('search', '');
        $limit  = $request->get('limit', '10');

        $enquiries = Enquiry::where('name', 'LIKE', '%'.$search.'%');
        $enquiries = ($limit == '*') ? $enquiries->get() : $enquiries->paginate($limit);

        $paginationAvailable = ($limit == '*') ? FALSE : TRUE;
        
        return view('admin.enquiry.index', compact('enquiries','search','limit','paginationAvailable'));
    }

    public function create() {
        return view('admin.enquiry.create');
    }

    public function store(Request $request) {

        request()->validate([
            'name' => 'required',
            'contact_number' => 'required',
            'source' => 'required',
            'gender' => 'required'
         ]);
        
        $enquiry = new Enquiry($request->all());
        $enquiry->save();

        return redirect()->route('enquiry.index')->with('success', 'Enquiry submitted successfully!');
    }

    public function edit($id){
        $data = Enquiry::findOrFail($id);
        return view('admin.enquiry.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $enquiry = Enquiry::findOrFail($id);
    
        request()->validate([
            'name' => 'required',
            'contact_number' => 'required',
            'source' => 'required',
            'gender' => 'required'
        ]);

        $enquiry->update($request->all());

        return redirect()->route('enquiry.index')->with('success', 'Enquiry updated successfully');
    }

    public function destroy($id) {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();

        return redirect()->route('enquiry.index')->with('success', 'Enquiry deleted successfully');
    }
}
