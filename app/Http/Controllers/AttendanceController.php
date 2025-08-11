<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\Attendance;

class AttendanceController extends Controller {

    public function index(Request $request){
        
        $date       = $request->input('attendance_date',now()->toDateString());
        $searchTerm = $request->input('member_search');

        $members = Member::whereDate('membership_end_date', '>', $date)
        ->when($searchTerm,function($query) use($searchTerm){
            $query->where('name','like','%'.$searchTerm.'%');
        })->get();

        return view('admin.attendance.index',compact('members','date'));
    }

    public function store(Request $request) {

        $attendances    = $request->input('attendance');
        $attendanceDate = $request->input('attendance_date',now()->toDateString());

        foreach ($attendances as $memberId => $status) {
            Attendance::updateOrCreate(
                ['member_id' => $memberId, 'attendance_date' => $attendanceDate],
                ['status' => $status]
            );
        }

        return redirect()->route('attendance.index')->with('success', 'Attendance recorded successfully');
    }
}
