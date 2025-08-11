<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Payment;

class PaymentsController extends Controller {

    public function index(Request $request){
        $limit  = $request->input('limit', 10);
        $search = $request->input('search');
    
        $members = Member::with('membershipPlan')
            ->when(!empty($search), function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->paginate($limit);

        return view('admin.payments.index', compact('members','search', 'limit'));
    }
}
