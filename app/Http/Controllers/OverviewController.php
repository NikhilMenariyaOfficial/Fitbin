<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Payment;

use Illuminate\Support\Facades\DB;

class OverviewController extends Controller {
    
    public function members(Request $request){
        $limit  = $request->input('limit',10);
        $search = $request->input('search');
        $fromDate = $request->input('fromDate', now()->subMonth()->format('Y-m-d'));
        $toDate   = $request->input('toDate', now()->format('Y-m-d'));

        $members = Member::whereBetween(DB::raw('DATE(created_at)'),[$fromDate, $toDate])
            ->when(!empty($search),function($query) use($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->paginate($limit);

        return view('admin.overview.members', compact('members', 'fromDate', 'toDate','search','limit'));
    }

    public function income(Request $request){
        $limit  = $request->input('limit',10);
        $search = $request->input('search');
        $fromDate = $request->input('fromDate', now()->subMonth()->format('Y-m-d'));
        $toDate   = $request->input('toDate', now()->format('Y-m-d'));

        $payments = Payment::whereBetween('payment_date', [$fromDate, $toDate])
            ->when(!empty($search), function ($query) use($search) {
                $query->whereHas('member', function ($subQuery) use($search) {
                    $subQuery->where('name', 'like', '%' . $search . '%');
                });
            })->with('member')->paginate($limit);

        return view('admin.overview.income', compact('payments', 'fromDate', 'toDate','search','limit'));
    }


    public function unpaidMembers(Request $request){
        $limit  = $request->input('limit',10);
        $search = $request->input('search');

        $members = Member::with('membershipPlan')
            ->where('pending_amount','>',0)
            ->when(!empty($search),function($query) use($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->paginate($limit);

        return view('admin.overview.unpaid-members', compact('members','search','limit'));
    }

    public function expiredMembers(Request $request) {
        $limit  = $request->input('limit', 10);
        $search = $request->input('search');
        $currentDate = now();
    
        $members = Member::with('membershipPlan')
            ->where('membership_end_date', '<', $currentDate)
            ->when(!empty($search), function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->paginate($limit);

        return view('admin.overview.expired-members', compact('members', 'search', 'limit'));
    }
}
