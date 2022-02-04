<?php


use App\Http\Controllers\AccountController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\Bed\BedAssignController;
use App\Http\Controllers\Bed\BedListController;
use App\Http\Controllers\Bed\BedTypeController;
use App\Http\Controllers\Billing\Advance\AdvancePaymentController;
use App\Http\Controllers\Billing\Bill\BillController;
use App\Http\Controllers\Blood\BloodDonorController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Doctor\ScheduleController;

use App\Http\Controllers\DoctorPercentage\DoctorPercentageController;
use App\Http\Controllers\InvestigationReportController;
use App\Http\Controllers\Invoice\PatientBillingInvoiceController;
use App\Http\Controllers\Invoice\SalaryInvoiceController;
use App\Http\Controllers\Invoice\TestInvoiceController;

use App\Http\Controllers\HumanResource\HumanResourceController;

use App\Http\Controllers\MailController;
use App\Http\Controllers\BirthController;
use App\Http\Controllers\DeathController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Lab\LabController;
use App\Http\Controllers\Medicine\MedicineCategoryController;
use App\Http\Controllers\Medicine\MedicineController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\OperationReportController;
use App\Http\Controllers\Patient\CaseStudyController;
use App\Http\Controllers\Patient\PatientAppointmentController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Blood\BloodInputController;
use App\Http\Controllers\Blood\BloodOutputController;

//use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\Test\TestCategoryController;
use App\Http\Controllers\Test\TestItemController;
use App\Http\Controllers\Test\TestReportController;
use App\Http\Controllers\Test\TestReportTemplateController;
use App\Http\Controllers\Test\TestRestultCategoryController;
use App\Http\Controllers\Test\TestResultItemController;
use App\Http\Controllers\Test\TestResultUnitController;
use App\Http\Controllers\User\ForgotPasswordController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\RoleController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use \App\Http\Controllers\Billing\Service\ServiceController;
use \App\Http\Controllers\Billing\Package\PackageController;
use \App\Http\Controllers\Billing\Admit\AdmitController;
use Illuminate\Support\Facades\URL;

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

//verification Notice
Route::get('/email/verify', function (Request $request) {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//Verify Email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');
//Resend Verification Mail
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return view('auth.resend-link');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'resetPasswordLink'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'passwordResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPassword'])->name('password.update');


//Login
Route::get('/', [UserController::class, 'loginPage'])->name('login-page');
Route::post('/login', [UserController::class, 'logIn'])->name('login');
Route::get('/login', [UserController::class, 'logIn']);


//Route::any('/login', function (Router $router) {
//    dd(Route::whereName('login')->methods());
//})->name('login');
//Route::middleware(['isValidRoute'])->group(function (){
//
//});


//Organization
//Route::resource('organization', OrganizationController::class);

//User
Route::middleware(['permission'])->group(function () {
    Route::resource('user', UserController::class)->middleware('verified');
});
Route::middleware(['permission'])->group(function () {
    Route::resource('profile', ProfileController ::class)->middleware('verified');
});

//Logout
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


//Dashboard
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware('auth', 'verified');


//Forget Password
//Route::get('forget-password', [ForgotPasswordController::class,'showForgetPasswordForm'])->name('forget.password.form');


//Role
Route::middleware(['permission'])->group(function () {
    Route::resource('role', RoleController::class)->middleware('verified');
});


//Route::middleware(['permission'])->group(function () {
//
////    Route::get('{uuid}/show', [DepartmentController::class, 'show'])->name('department.show');
//});
//Route::resource('role', RoleController::class)->middleware( 'verified');
//Route::resource('role', RoleController::class)->middleware( 'verified');
//Route::get('role/list', [RoleController::class, 'getRoles'])->name('role.list');
//Route::post('role/single-destroy-permission/{id}', [RoleController::class, 'singleDestroyPermission'])->name('role.single-destroy-permission');
//Route::get('role/single-destroy-permission/{id}', [RoleController::class, 'singleDestroyPermission'])->name('role.test');


//Permission
Route::middleware(['permission'])->group(function () {
    Route::resource('permission', PermissionController::class)->middleware('verified');
});


//Route::group(['middleware' => ['verified', 'permission']], function() {
//    // uses 'auth' middleware plus all middleware from $middlewareGroups['web']
//
//});
//Department
Route::middleware(['permission'])->group(function () {
    Route::resource('department', DepartmentController::class);
});


//patient
Route::middleware(['permission'])->group(function () {
    Route::resource('patient', PatientController::class)->middleware('verified');

});

Route::get('patient/document', [PatientController::class, 'document'])->name('patient.document');
Route::get('patient/{uuid}/history', [PatientController::class, 'history'])->name('patient.history');
Route::get('/patient/get-doctor/{type?}/{id?}', [PatientController::class, 'getDoctor']);

//Bed List
Route::middleware(['permission'])->group(function () {
    Route::resource('bed-list', BedListController::class)->middleware('verified');
});


//Bed Type
Route::middleware(['permission'])->group(function () {
    Route::resource('bed-type', BedTypeController::class)->middleware('verified');
});


//Bed Assign
Route::middleware(['permission'])->group(function () {
    Route::resource('bed-assign', BedAssignController::class)->middleware('verified');
});


//Birth
Route::middleware(['permission'])->group(function () {
    Route::resource('birth', BirthController::class)->middleware('verified');
});


//Death
Route::middleware(['permission'])->group(function () {
    Route::resource('death', DeathController::class)->middleware('verified');
});


//Blood
Route::middleware(['permission'])->group(function () {
    Route::resource('blood-input', BloodInputController::class)->middleware('verified');
});
Route::middleware(['permission'])->group(function () {
    Route::resource('blood-output', BloodOutputController::class)->middleware('verified');
});
Route::middleware(['permission'])->group(function () {
    Route::resource('blood-donor', BloodDonorController::class)->middleware('verified');
});


//Sms
Route::middleware(['permission'])->group(function () {
    Route::resource('sms', SmsController::class)->middleware('verified');
});
//Mail
//Route::resource('mail', MailController::class);

// Ambulance
Route::middleware(['permission'])->group(function () {
    Route::resource('ambulance', AmbulanceController::class)->middleware('verified');
});


//Lab
Route::middleware(['permission'])->group(function () {
    Route::resource('lab', LabController::class)->middleware('verified');
});


//Notice
Route::middleware(['permission'])->group(function () {
    Route::resource('notice', NoticeController::class)->middleware('verified');
});
//Download Notice
Route::get('{uuid}/download', [NoticeController::class, 'download'])->name('notice.download');

//Doctor
Route::middleware(['permission'])->group(function () {
    Route::resource('doctor', DoctorController::class)->middleware('verified');
});


//Appointment
Route::middleware(['permission'])->group(function () {
    Route::resource('appointment', PatientAppointmentController::class)->middleware('verified');
    Route::get('/appointment-for-today', [PatientAppointmentController::class, 'appointments'])->name('appointment-for-today.appointments')->middleware('verified');
});
//API call
Route::get('/appointment/get-doctor/{type}/{id}', [PatientAppointmentController::class, 'getDoctor']);
Route::get('/appointment/get-slot/{uuid}/{day}', [PatientAppointmentController::class, 'getSlot']);
Route::get('/appointment/get-patient/{id}', [PatientAppointmentController::class, 'findPatient']);



//Account
Route::middleware(['permission'])->group(function () {
    Route::resource('account', AccountController::class)->middleware('verified');
});

//Payment
Route::middleware(['permission'])->group(function () {
    Route::resource('payment', PaymentController::class)->middleware('verified');
});

//Report
Route::middleware(['permission'])->group(function () {
    Route::get('report-debit', [ReportController::class, 'debit'])->name('report.debit')->middleware('verified');
    Route::get('report-credit', [ReportController::class, 'credit'])->name('report.credit')->middleware('verified');
});
Route::get('/report/credit-report/{filter}', [ReportController::class, 'getCredit'])->name('credit');

//Schedule
Route::middleware(['permission'])->group(function () {
    Route::resource('schedule', ScheduleController::class)->middleware('verified');
});


//Services
Route::middleware(['permission'])->group(function () {
    Route::resource('billing/service', ServiceController::class)->middleware('verified');
});


//Package
Route::middleware(['permission'])->group(function () {
    Route::resource('billing/package', PackageController::class)->middleware('verified');
});

Route::get('/test/{services}', [PackageController::class, 'test']);

//Patient-admit
Route::middleware(['permission'])->group(function () {
    Route::resource('billing/admit', AdmitController::class);
});


//Advance-Payment
Route::middleware(['permission'])->group(function () {
    Route::resource('billing/advance', AdvancePaymentController::class);
});


//Bill
Route::middleware(['permission'])->group(function () {
    Route::resource('billing/bill', BillController::class);
});


//Prescription
Route::middleware(['permission'])->group(function () {
    Route::resource('patient-case-study', CaseStudyController::class);
});


//Setting
//Route::resource('setting', SettingController::class);
Route::middleware(['permission'])->group(function () {
    Route::get('setting', [SettingController::class, 'create'])->name('setting.create')->middleware('verified');
    Route::post('setting/update', [SettingController::class, 'store'])->name('setting.store')->middleware('verified');
});


//Operation Report
Route::middleware(['permission'])->group(function () {
    Route::resource('operation-report', OperationReportController::class);
});


//Investigation Report
Route::middleware(['permission'])->group(function () {
    Route::resource('investigation-report', InvestigationReportController::class);
});


//Medicine Category
Route::middleware(['permission'])->group(function () {
    Route::resource('medicine-category', MedicineCategoryController::class);
});


//Medicine
Route::middleware(['permission'])->group(function () {
    Route::resource('medicine', MedicineController::class);
});


//Human Resource
Route::middleware(['permission'])->group(function () {
    Route::resource('human-resource', HumanResourceController::class)->middleware('verified');
    Route::get('human-resource-accountant', [HumanResourceController::class, 'accountant'])->name('human-resource.accountant');
    Route::get('human-resource-nurse', [HumanResourceController::class, 'nurse'])->name('human-resource.nurse');
    Route::get('human-resource-laboratorist', [HumanResourceController::class, 'laboratorist'])->name('human-resource.laboratorist');
    Route::get('human-resource-pharmacist', [HumanResourceController::class, 'pharmacist'])->name('human-resource.pharmacist');
    Route::get('human-resource-receptionist', [HumanResourceController::class, 'receptionist'])->name('human-resource.receptionist');
});


//Test
//Route::middleware(['permission'])->group(function () {
//    Route::resource('test-category', TestCategoryController::class );
////    Route::get('{uuid}/show', [PatientController::class, 'show'])->name('patient.show');
//});
//Test Category
Route::middleware(['permission'])->group(function () {
    Route::resource('test-category', TestCategoryController::class)->middleware('verified');
});

//Test Item
Route::middleware(['permission'])->group(function () {
    Route::resource('test-item', TestItemController::class)->middleware('verified');
});
//Test Result Category
Route::middleware(['permission'])->group(function () {
    Route::resource('test-result-category', TestRestultCategoryController::class)->middleware('verified');
});
//Test Result Item
Route::middleware(['permission'])->group(function () {
    Route::resource('test-result-item', TestResultItemController::class)->middleware('verified');
});
Route::middleware(['permission'])->group(function () {
    Route::resource('test-result-unit', TestResultUnitController::class)->middleware('verified');
});
Route::middleware(['permission'])->group(function () {
    Route::resource('test-report', TestReportController::class)->middleware('verified');
});
Route::get('/test-report/get-invoice-info/{number}', [TestReportController::class, 'findPatientByInvoice']);
Route::get('/test-report/get-template/{test}', [TestReportController::class, 'findTemplate']);


Route::middleware(['permission'])->group(function () {
    Route::resource('test-report-template', TestReportTemplateController::class)->middleware('verified');
});


Route::middleware(['permission'])->group(function () {
    Route::resource('salary-invoice', SalaryInvoiceController::class)->middleware('verified');
});
Route::get('/salary-invoice/get-staff-by-number/{number}', [SalaryInvoiceController::class, 'findStaffByNumber']);
Route::get('/salary-invoice/pdf/{invoiceNumber}', [SalaryInvoiceController::class, 'invoicePdf'])->name('salary-invoice.pdf');


//Test Invoice
Route::middleware(['permission'])->group(function () {
    Route::resource('test-invoice', TestInvoiceController::class)->middleware('verified');
    Route::get('/test-invoice/pdf/{invoiceNumber}', [TestInvoiceController::class, 'pdf'])->name('test-invoice.pdf')->middleware('verified');
});

Route::get('/test-invoice/get-patient/{pid}', [TestInvoiceController::class, 'findPatient']);
Route::get('/test-invoice/get-patient-by-number/{number}', [TestInvoiceController::class, 'findPatientByNumber']);

//Billing Invoice
Route::middleware(['permission'])->group(function () {
    Route::resource('patient-billing-invoice', PatientBillingInvoiceController::class)->middleware('verified');
    Route::get('/patient-billing-invoice/pdf/{invoiceNumber}', [PatientBillingInvoiceController::class, 'pdf'])->name('patient-billing-invoice.pdf')->middleware('verified');
});

//Doctor Percentage
Route::middleware(['permission'])->group(function () {
    Route::resource('doctor-percentage', DoctorPercentageController::class)->middleware('verified');
});
Route::get('/doctor-percentage/get-doctor-percentage/{id}', [DoctorPercentageController::class, 'getDoctorPercentage']);








