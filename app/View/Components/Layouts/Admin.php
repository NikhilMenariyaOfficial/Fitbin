<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use App\Models\Member;
use App\Models\Setting;

class Admin extends Component {
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(){}
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render(){
        $membersWithPendingFees = Member::where('pending_amount', '>', 0)->get();
        $expiredMembers = Member::whereDate('membership_end_date', '<', now())->get();
        $setting = Setting::first();

        return view('layouts.admin',compact('membersWithPendingFees','expiredMembers','setting'));
    }
}
