<?php

use App\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SupplimentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\PatientController;
use App\Http\Controllers\Front\ClinicalsController;
use App\Http\Controllers\Front\DashboardController;
use App\Http\Controllers\Front\InventoryController;
use App\Http\Controllers\Front\VitalSignController;
use App\Http\Controllers\ClinicalEncounterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Front\ImmunizationController;
use App\Http\Controllers\Front\PublicHealthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Front\PublichealthAnswerController;

/*
|--------------------------------------------------------------------------
| Web Routes/
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware'=>'localizaion'], function(){

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('web.installer');
Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/forget',  function () {
	return view('pages.forgot-password');
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');



/*--------------------THESE ROUTES ARE WRITTEN BY TANVIR SAKIB-------------------- */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home')->middleware('web.installer');
    Route::get('/language/{lang?}', [DashboardController::class, 'language'])->name('home.language');
    // dashboard route
	Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('dashboard')->middleware('adminMiddleware');
    // logout route
	Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/session/clinic/{id}', [DashboardController::class, 'sessionClinic'])->name('session.clinic');
    Route::get('/main/dashboard', [DashboardController::class, 'index'])->name('main.dashboard');
    Route::get('/profile', [DashboardController::class, 'profileShow'])->name('profile.show');
    Route::post('/profile/update', [DashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::post('/change-password', [DashboardController::class, 'changePassword'])->name('password.change');
    Route::get('/edit/patient-chart/{id}', [PatientController::class, 'editPatientChart'])->name('edit.patient-chart');
    Route::post('/edit/patient-chart/{id}', [PatientController::class, 'editPatientChart'])->name('edit.patient-chart.post');
    Route::get('/search/patient', [PatientController::class, 'searchPatientGlobally'])->name('search.patient.global');

    //clinicals
    Route::get('/clinicals', 'Front\ClinicalsController@index')->name('clinicals.index');
    Route::get('/clinicals/checkin/{id}', 'Front\ClinicalsController@checkin')->name('clinicals.checkin');
    Route::post('/clinicals/searchbyname', 'Front\ClinicalsController@searchbyname')->name('clinicals.searchbyname');
    Route::post('clinicals/add/checkedin', [ClinicalsController::class, 'addToCheckedIn'])->name('clinicals.add.checkedin');
    Route::get('/clinicals/delete/{id}', [ClinicalsController::class, 'destroy'])->name('clinical.delete');

    Route::post('/patient/add-parent/{id}', [PatientController::class, 'add_parent'])->name('add-parent');
    Route::post('/patient/add-prenatal-history/{id}', [PatientController::class, 'addPrenatalHistory'])->name('add-prenatal-history');
    Route::post('/patient/edit-prenatal-history/{id}', [PatientController::class, 'editPrenatalHistory'])->name('edit-prenatal-history');
    Route::post('/patient/add-birth-information/{id}', [PatientController::class, 'addBirthInformation'])->name('add-birth-information');
    Route::post('/patient/edit-birth-information/{id}', [PatientController::class, 'editBirthInformation'])->name('edit-birth-information');

    //public health
    Route::get('patient/public-health-question/{patient_id}', [PatientController::class, 'publicHealthQuestion'])->name('patient.public-health');
    Route::post('/patient/public-health-question/intermittenthealthform', [PublicHealthController::class, 'intermittenthealth'])->name('publichealth.intermittenthealth');
    Route::post('/patient/public-health-question/intermittenthealthform/{id}', [PublicHealthController::class, 'intermittenthealthupdate'])->name('publichealth.intermittenthealth.edit');

    Route::post('/patient/public-health-question/maternal-health', [PublicHealthController::class, 'maternalHealthStore'])->name('publichealth.maternal-health');
    Route::post('/patient/public-health-question/maternal-health/update/{id}', [PublicHealthController::class, 'maternalHealthUpdate'])->name('publichealth.maternal-health.edit');

    Route::post('/patient/public-health-question/agricultural', [PublicHealthController::class, 'agriculturalStore'])->name('publichealth.agricultural');
    Route::post('/patient/public-health-question/agricultural/update/{id}', [PublicHealthController::class, 'agriculturalUpdate'])->name('publichealth.agricultural.edit');

    Route::post('/patient/public-health-question/paternal-history', [PublicHealthController::class, 'paternalHistoryStore'])->name('publichealth.paternal-history');
    Route::post('/patient/public-health-question/paternal-history/update/{id}', [PublicHealthController::class, 'paternalHistoryUpdate'])->name('publichealth.paternal-history.edit');

    //vital sign
    Route::get('/patient/vital-sign/{patient_id}', [VitalSignController::class, 'index'])->name('patient.vital-sign');
    Route::post('/patient/vital-sign/store', [VitalSignController::class, 'store'])->name('patient.vital-sign.store');
    Route::post('/patient/vital-sign/storeajax', [VitalSignController::class, 'storefromajax'])->name('patient.vital-sign.storefromajax');

    //clinical encounter
    Route::get('/patient/clinical-encounter/{patient_id}', [ClinicalEncounterController::class, 'index'])->name('patient.clinical-encounter');

    Route::post('/patient/clinical-encounter/store', [ClinicalEncounterController::class, 'clinicalEncounterStore'])->name('publichealth.clinical-encounter');
    Route::post('/patient/clinical-encounter/update/{id}', [ClinicalEncounterController::class, 'clinicalEncounterUpdate'])->name('publichealth.clinical-encounter.edit');

    Route::post('/patient/clinical-encounter/storecode/{id}', [ClinicalEncounterController::class, 'storecode'])->name('publichealth.clinical-encounter.storecode');
    Route::get('/patient/clinical-encounter/getcode/{patient}', [ClinicalEncounterController::class, 'getcode'])->name('publichealth.clinical-encounter.getcode');

    Route::post('/patient/clinical-encounter/deletecode/{patient}/{code}', [ClinicalEncounterController::class, 'deletecode'])->name('publichealth.clinical-encounter.deletecode');

    Route::post('medication/add', [ClinicalEncounterController::class, 'addMedication'])->name('add.medication');
    Route::post('suppliment/add', [ClinicalEncounterController::class, 'addSuppliment'])->name('add.suppliment');

    //inventory
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::post('inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
    Route::post('inventory/update/{inventory_id}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::get('inventory/delete/{product}', [InventoryController::class, 'destroy'])->name('inventory.delete');
    Route::get('drugs/{drug}', [InventoryController::class, 'drugInfo'])->name('drug.info');

    //suppliments
    Route::get('/supplements', [SupplimentController::class, 'index'])->name('suppliment.index');
    Route::post('supplements/store', [SupplimentController::class, 'store'])->name('suppliment.store');
    Route::post('supplements/update/{suppliment_id}', [SupplimentController::class, 'update'])->name('suppliment.update');
    Route::get('supplements/delete/{product}', [SupplimentController::class, 'destroy'])->name('suppliment.delete');
    Route::get('foods/{suppliment}', [SupplimentController::class, 'foodInfo'])->name('food.info');

    //immunization
    Route::get('/patient/immunization/{patient_id}', [ImmunizationController::class, 'index'])->name('immunization.index');
    Route::post('/patient/immunization/add/{patient_id}', [ImmunizationController::class, 'pushVaccine'])->name('immunization.add');

    //orders
    Route::get('patient/orders/{patient_id}', [OrderController::class, 'index'])->name('patient.order.index');
    Route::post('/order/update/{order_id}', [OrderController::class, 'update'])->name('order.update');
    Route::get('patient/suppliments/orders/{patient_id}', [OrderController::class, 'supplimentOrdersShow'])->name('patient.suppliment.order.index');
    Route::post('/suppliments/order/update/{order_id}', [OrderController::class, 'supplimentOrderUpdate'])->name('suppliment.order.update');

    //Send Message
    Route::post('/message/send', [MessageController::class, 'sendMessage'])->name('send.message');

    //checkout
    Route::get('/checkout', [PatientController::class, 'checkout'])->name('checkout');

    Route::group(['prefix' => 'medical-assistant'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('ma.dashboard');
    });

    Route::group(['prefix' => 'doctor'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('doctor.dashboard');
    });

    Route::group(['prefix' => 'pharmasist'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('pharmasist.dashboard');
    });

});

//intermittenthealthanswer
Route::post('/intermittenthealthanswer', [PublichealthAnswerController::class, 'store'])->name('intermittenthealthanswer.store');
Route::post('/intermittenthealthanswer/update/{id}', [PublichealthAnswerController::class, 'update'])->name('intermittenthealthanswer.update');
Route::post('/intermittenthealthanswer/maternal', [PublichealthAnswerController::class, 'maternalstore'])->name('intermittenthealthanswer.maternalstore');
Route::post('/intermittenthealthanswer/maternal/update/{id}', [PublichealthAnswerController::class, 'maternalupdate'])->name('intermittenthealthanswer.maternalupdate');
Route::post('/intermittenthealthanswer/parental', [PublichealthAnswerController::class, 'parentalstore'])->name('intermittenthealthanswer.parentalstore');
Route::post('/intermittenthealthanswer/parental/update/{id}', [PublichealthAnswerController::class, 'parentalupdate'])->name('intermittenthealthanswer.parentalupdate');
Route::post('/intermittenthealthanswer/agricultural', [PublichealthAnswerController::class, 'agriculturalstore'])->name('intermittenthealthanswer.agriculturalstore');
Route::post('/intermittenthealthanswer/agricultural/update/{id}', [PublichealthAnswerController::class, 'agriculturalupdate'])->name('intermittenthealthanswer.agriculturalupdate');

//add new patient
Route::post('/addnewpatient', 'Front\PatientController@store')->name('patient.store');
Route::get('/deletepatient/{patient}', 'Front\PatientController@delete')->name('patient.delete');
Route::post('patient/image/update/{patient}', 'Front\PatientController@imageupdate')->name('patient.image.update');
Route::post('user/image/update/{user}', [DashboardController::class, 'imageupdate'])->name('user.image.update');

});
