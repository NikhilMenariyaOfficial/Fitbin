<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\Attendance;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ReportsController extends Controller {

    public function attendance(Request $request) {

        $currentMonth = now()->format('m');
        $daysInMonth  = Carbon::create(now()->year,now()->month, 1)->daysInMonth;
        
        $members = Member::select(['id', 'name'])->with(['attendance' => function ($query) use ($currentMonth) {
            $query->select(['member_id','attendance_date', 'status'])
                ->whereRaw('MONTH(attendance_date) = ?', [$currentMonth])
                ->orderBy('attendance_date', 'asc');
        }])->get()->toArray();

        $members = $this->getAttendanceData($members); 

        return view('admin.reports.attendance', compact('members', 'daysInMonth'));   
    }

    protected function getAttendanceData($members){
        $currentMonth = Carbon::now()->startOfMonth();
        $daysInMonth  = $currentMonth->daysInMonth;
        $dateRange    = $currentMonth->toPeriod($currentMonth->copy()->addDays($daysInMonth - 1), '1 day');

        $monthData = array_map(function ($date) {
            return [$date->format('Y-m-d') => ['attendance_date' => $date->format('Y-m-d'), 'status' => '-']];
        }, iterator_to_array($dateRange));

        $monthData = call_user_func_array('array_merge_recursive', $monthData);

        $attendanceData = array();

        foreach ($members as $index => $member) {
            $member = (object) $member;

            $member->attendance = array_map(function ($data) {
                return [$data['attendance_date'] => $data];
            },$member->attendance);

            $member->attendance = call_user_func_array('array_merge_recursive',(array) $member->attendance);
            $member->attendance = array_merge($monthData,$member->attendance);
            $member->attendance = array_values($member->attendance);

            $attendanceData[] = $member;
        }

        return $attendanceData;
    }

    public function generate(Request $request){
        return view('admin.reports.generate');
    }
}
