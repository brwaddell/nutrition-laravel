<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\VaccineController;
use App\Http\Controllers\Admin\PatientsController;
use App\Http\Controllers\Admin\PublicHealthQuestionController;

//user
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/user/create', 'UsersController@create')->name('user.create');
Route::post('/user/store', 'UsersController@store')->name('user.store');
Route::get('/user/{user}/show', 'UsersController@show')->name('user.show');
Route::get('/user/{user}/delete', 'UsersController@delete')->name('user.delete');
Route::post('/user/{user}/update', 'UsersController@update')->name('user.update');

/*-------------------------Admin Routes---------------------------- */
Route::get('/users/{roles}', [AdminController::class, 'index'])->name('users.admins.index');
Route::get('/users/{roles}/create', [AdminController::class, 'create'])->name('users.admins.create');

//clinic
Route::get('/clinics', 'Admin\ClinicController@index')->name('clinic.index');
Route::get('/clinics/create', 'Admin\ClinicController@create')->name('clinic.create');
Route::post('/clinic/store', 'Admin\ClinicController@store')->name('clinic.store');
Route::get('/clinic/{clinic}/show', 'Admin\ClinicController@show')->name('clinic.show');
Route::get('/clinic/{clinic}/delete', 'Admin\ClinicController@delete')->name('clinic.delete');
Route::post('/clinic/{clinic}/update', 'Admin\ClinicController@update')->name('clinic.update');

//site settings
Route::get('/site/create', 'Admin\SiteController@create')->name('sites.create');
Route::post('/site/store', 'Admin\SiteController@store')->name('sites.store');
Route::post('/site/{id}/update', 'Admin\SiteController@update')->name('sites.update');

//vaccine
Route::get('/vaccines', [VaccineController::class, 'index'])->name('vaccine.index');
Route::get('/vaccines/create', [VaccineController::class, 'create'])->name('vaccine.create');
Route::post('/vaccine/store', [VaccineController::class, 'store'])->name('vaccine.store');
Route::get('/vaccine/{vaccine}/show', [VaccineController::class, 'show'])->name('vaccine.show');
Route::post('/vaccine/{vaccine}/update', [VaccineController::class, 'update'])->name('vaccine.update');
Route::get('/vaccine/{vaccine}/delete', [VaccineController::class, 'delete'])->name('vaccine.delete');

//patients
Route::get('/patients', [PatientsController::class, 'index'])->name('patient.index');

//message
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

//public health question
Route::get('/publichealthquestion', [PublicHealthQuestionController::class, 'index'])->name('publichealthquestion.index');
Route::get('/publichealthquestion/create', [PublicHealthQuestionController::class, 'create'])->name('publichealthquestion.create');
Route::post('/publichealthquestion/store', [PublicHealthQuestionController::class, 'store'])->name('publichealthquestion.store');
Route::get('/form/question/edit/{id}', [PublicHealthQuestionController::class, 'edit'])->name('publichealthquestion.edit');
Route::post('/publichealthquestion/{id}/update', [PublicHealthQuestionController::class, 'update'])->name('publichealthquestion.update');
Route::get('/publichealthquestion/{id}/delete', [PublicHealthQuestionController::class, 'delete'])->name('publichealthquestion.delete');

Route::get('/form/{id}', [PublicHealthQuestionController::class, 'formIndex'])->name('publichealthquestion.form.index');
Route::get('/form/{id}/create', [PublicHealthQuestionController::class, 'formCreate'])->name('publichealthquestion.form.create');
