<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Member;
use App\Models\Enquiry;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

use Illuminate\Validation\Rule;
use App\Rules\CheckHashedPassword;

class HomeController extends Controller {
    public function dashboard(){

        $currentMonth = now()->month;
        $currentYear = now()->year;

        $totalEarning = Payment::sum('amount');
        $totalEarningCurrentMonth = Payment::whereYear('payment_date', $currentYear)
            ->whereMonth('payment_date', $currentMonth)
            ->sum('amount');

        $totalEnquiries = Enquiry::count();
        $totalMembers  = Member::count();
        $unpaidMembers = Member::where('pending_amount', '>', 0)->count();
        $joinedThisMonth = Member::whereMonth('membership_start_date', Carbon::now()->month)->count();
        $expiredMemberships = Member::whereDate('membership_end_date', '<', Carbon::now())->count();

        $dateTime = Carbon::now();
        $time = Carbon::now();
        $dateTime = $dateTime->format('F d, Y l');
        $time = $time->format('h:i A');

        $chart = (object) array();
        $chart->sales = Payment::whereYear('payment_date',Carbon::now()->year)
            ->select(DB::raw('MONTH(payment_date) as month'), DB::raw('SUM(amount) as total'))
            ->groupBy(DB::raw('MONTH(payment_date)'))
            ->get();

        $chart->sales = $chart->sales->map(function ($item) {
            return [
                'month' => Carbon::create()->month($item['month'])->format('F'),
                'total' => $item['total'],
            ];
        });

        $chart->currentMonthSales = Payment::whereYear('payment_date', Carbon::now()->year)
            ->whereMonth('payment_date', Carbon::now()->month)
            ->sum('amount');

        $chart->lastMonthSales = Payment::whereYear('payment_date', Carbon::now()->subMonth()->year)
            ->whereMonth('payment_date', Carbon::now()->subMonth()->month)
            ->sum('amount');

        return view('admin.dashboard',compact('chart','totalEarning','totalEarningCurrentMonth','totalMembers','unpaidMembers','joinedThisMonth','expiredMemberships','dateTime','time','totalEnquiries'));
    }

    public function profile() {
        $userDetails = Auth::user();
        return view('admin.profile',compact('userDetails'));
    }

    public function profileUpdate(Request $request) {
        $validation = $this->profileValidation();
        $request->validate($validation->rules,$validation->messages);

        $user = Auth::user();
        $user->update($request->all());

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    private function profileValidation() {
        $settings = (object) array();

        $settings->rules = array(
            'first_name' => 'max:15',
            'last_name' => 'max:20',
            'email' => 'email',
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'address' => 'max:40',
            'number' => 'numeric',
            'city' => 'max:20',
            'ZIP' => 'required|numeric|digits:5'
        ); 

        $settings->messages = array(
            'first_name.max' => 'The first name must not exceed 15 characters.',
            'last_name.max' => 'The last name must not exceed 20 characters.',
            'email.email' => 'Please enter a valid email address.',
            'gender.required' => 'Please select a gender.',
            'gender.in' => 'Invalid gender selected.',
            'address.max' => 'The address must not exceed 40 characters.',
            'number.numeric' => 'Please enter a valid numeric value for the number.',
            'city.max' => 'The city must not exceed 20 characters.',
            'ZIP.required' => 'The ZIP code is required.',
            'ZIP.numeric' => 'The ZIP code must be a numeric value.',
            'ZIP.digits' => 'The ZIP code must be exactly 5 digits.',
        );

        return $settings;
    }

    public function profilePassword(Request $request) {
        $validation = $this->passwordValidation();
        $request->validate($validation->rules,$validation->messages);

        $user = Auth::user();
        $user->update(['password' => Hash::make($request->input('new_password'))]);
    
        return redirect()->back()->with('success', 'Password updated successfully');    
    }

    private function passwordValidation() {
        $settings = (object) array();

        $settings->rules = array(
            'current_password' => ['required', new CheckHashedPassword],
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|same:new_password',
        ); 

        $settings->messages = array(
            'current_password.required' => 'Please enter your current password.',
            'current_password.password' => 'The current password is incorrect.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'The new password must be at least 8 characters.',
            'new_password_confirmation.required' => 'Please confirm the new password.',
            'new_password_confirmation.same' => 'The new password confirmation does not match.',
        );

        return $settings;
    }
}
