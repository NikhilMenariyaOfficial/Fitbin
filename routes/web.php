<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Lock;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MemberController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\MembershipPlanController;
use App\Http\Controllers\PersonalTrainingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembershipRequestController;
use App\Http\Controllers\MembershipHistoryController;
use App\Http\Controllers\TermsAndConditionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** -- @auth.routes -------------------------------------------------------------------------------------------------------- */

Route::redirect('/', '/login');
// Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

/** -- @casual.fitness ----------------------------------------------------------------------------------------------------- */

Route::middleware(['auth', 'protector'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/lock', Lock::class)->name('lock');
});

Route::prefix('profile')->middleware(['auth', 'protector'])->group(function () {
    Route::get('/',  [HomeController::class, 'profile'])->name('profile');
    Route::post('/', [HomeController::class, 'profileUpdate'])->name('profile.update');
    Route::patch('/', [HomeController::class, 'profilePassword'])->name('profile.password');
});

Route::prefix('members')->middleware(['auth', 'protector'])->group(function () {

    Route::get('/export', [MemberController::class, 'export'])->name('members.export');

    Route::get('/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('/create', [MemberController::class, 'store'])->name('members.store');

    Route::get('/', [MemberController::class, 'index'])->name('members.index');
    Route::get('/{id}', [MemberController::class, 'show'])->name('members.show');

    Route::get('/{id}/membership-renew', [MemberController::class, 'membershipRenew'])->name('members.membership.renew');
    Route::put('/{id}/membership-renew', [MemberController::class, 'membershipRenewStore'])->name('members.membership.renew.store');

    Route::get('/{id}/membership-payment', [MemberController::class, 'membershipPayment'])->name('members.membership.payment');
    Route::put('/{id}/membership-payment', [MemberController::class, 'membershipPaymentStore'])->name('members.membership.payment.store');

    Route::get('/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/{id}', [MemberController::class, 'update'])->name('members.update');

    Route::delete('/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
});

Route::prefix('membership-plans')->middleware(['auth', 'protector'])->group(function () {

    Route::get('/create', [MembershipPlanController::class, 'create'])->name('membership-plans.create');
    Route::post('/create', [MembershipPlanController::class, 'store'])->name('membership-plans.store');

    Route::get('/', [MembershipPlanController::class, 'index'])->name('membership-plans.index');
    Route::get('/{plan}', [MembershipPlanController::class, 'show'])->name('membership-plans.show');

    Route::get('/{plan}/edit', [MembershipPlanController::class, 'edit'])->name('membership-plans.edit');
    Route::put('/{plan}', [MembershipPlanController::class, 'update'])->name('membership-plans.update');

    Route::delete('/{plan}', [MembershipPlanController::class, 'destroy'])->name('membership-plans.destroy');
});

Route::prefix('membership-histories')->middleware(['auth', 'protector'])->group(function () {

    Route::get('/create', [MembershipHistoryController::class, 'create'])->name('membership-histories.create');
    Route::post('/', [MembershipHistoryController::class, 'store'])->name('membership-histories.store');

    Route::get('/', [MembershipHistoryController::class, 'index'])->name('membership-histories.index');

    Route::get('/{id}/edit', [MembershipHistoryController::class, 'edit'])->name('membership-histories.edit');
    Route::put('/{id}', [MembershipHistoryController::class, 'update'])->name('membership-histories.update');

    Route::delete('/{id}', [MembershipHistoryController::class, 'destroy'])->name('membership-histories.destroy');
});

Route::prefix('personal-training')->middleware(['auth', 'protector'])->group(function () {

    Route::get('/create', [PersonalTrainingController::class, 'create'])->name('personal-training.create');
    Route::get('/members', [PersonalTrainingController::class, 'members'])->name('personal-training.members');
    Route::post('/', [PersonalTrainingController::class, 'store'])->name('personal-training.store');

    Route::get('/', [PersonalTrainingController::class, 'index'])->name('personal-training.index');
    Route::get('/{id}', [PersonalTrainingController::class, 'show'])->name('personal-training.show');

    Route::get('/{id}/edit', [PersonalTrainingController::class, 'edit'])->name('personal-training.edit');
    Route::put('/{id}', [PersonalTrainingController::class, 'update'])->name('personal-training.update');

    Route::delete('/{id}', [PersonalTrainingController::class, 'destroy'])->name('personal-training.destroy');
});

Route::prefix('settings')->middleware(['auth', 'protector'])->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('settings');
    Route::post('/', [SettingsController::class, 'store'])->name('settings.store');
    Route::post('/upload', [SettingsController::class, 'handleUpload'])->name('settings.upload');
});

Route::prefix('overview')->middleware(['auth', 'protector'])->group(function () {
    Route::get('/members', [OverviewController::class, 'members'])->name('overview.members');
    Route::get('/income', [OverviewController::class, 'income'])->name('overview.income');
});

Route::prefix('alert')->middleware(['auth', 'protector'])->group(function () {
    Route::get('/unpaid-members',  [OverviewController::class, 'unpaidMembers'])->name('alert.unpaid-members');
    Route::get('/expired-members', [OverviewController::class, 'expiredMembers'])->name('alert.expired-members');
});

Route::prefix('reports')->middleware(['auth', 'protector'])->group(function () {
    Route::get('/attendance', [ReportsController::class, 'attendance'])->name('reports.attendance-reports');
    Route::get('/generate',   [ReportsController::class, 'generate'])->name('reports.generate-reports');
});

Route::prefix('payments')->middleware(['auth', 'protector'])->group(function () {
    Route::get('/',   [PaymentsController::class, 'index'])->name('payments.index');
    Route::post('/',  [PaymentsController::class, 'store'])->name('payments.store');
});

Route::prefix('attendance')->middleware(['auth', 'protector'])->group(function () {
    Route::get('/',       [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/',      [AttendanceController::class, 'store'])->name('attendance.store');
});

Route::prefix('enquiry')->middleware(['auth', 'protector'])->group(function () {
    Route::get('/create', [EnquiryController::class, 'create'])->name('enquiry.create');
    Route::post('/', [EnquiryController::class, 'store'])->name('enquiry.store');

    Route::get('/', [EnquiryController::class, 'index'])->name('enquiry.index');

    Route::get('/{id}/edit', [EnquiryController::class, 'edit'])->name('enquiry.edit');
    Route::put('/{id}', [EnquiryController::class, 'update'])->name('enquiry.update');

    Route::delete('/{id}', [EnquiryController::class, 'destroy'])->name('enquiry.delete');
});

Route::prefix('membership-request')->group(function () {
    Route::get('/', [MembershipRequestController::class, 'index'])->name('membership-request.index');
    Route::post('/', [MembershipRequestController::class, 'store'])->name('membership-request.store');
    Route::get('/thank-you', [MembershipRequestController::class, 'thankYou'])->name('membership-request.thankyou');

    Route::middleware(['auth', 'protector'])->group(function () {
        Route::get('/pending-registrations', [MembershipRequestController::class, 'showPendingRegistrations'])->name('membership-request.pending.registrations');
        Route::put('/approve-registration/{temporaryMember}', [MembershipRequestController::class, 'approveRegistration'])->name('membership-request.approve.registration');
        Route::delete('/reject-registration/{temporaryMember}', [MembershipRequestController::class, 'rejectRegistration'])->name('membership-request.reject.registration');
    });
});

Route::get('/terms-and-conditions', [TermsAndConditionsController::class, 'show'])->name('terms-and-conditions.show');
Route::prefix('terms')->middleware(['auth', 'protector'])->group(function () {
    Route::get('/', [TermsAndConditionsController::class, 'index'])->name('terms.index');
    Route::post('/', [TermsAndConditionsController::class, 'store'])->name('terms.store');
});

/** ------------------------------------------------------------------------------------------------------------------------ */
