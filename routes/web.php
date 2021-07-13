<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', function () {
        if (\Auth::user()->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('client.dashboard');
        }
    });

    Route::prefix('client')->name('client.')->namespace('Client')->middleware(['role:Help Desk|Assessment|CRPD'])->group(function () {
        Route::get('dashboard', "DashboardController@index")->name('dashboard');
        Route::get('check-applicant-status', "DashboardController@checkApplicantStatus")->name('check.applicant.status');
        Route::resource('applications', 'ApplicationController', ['only' => ['index', 'store', 'create', 'edit', 'update']]);    
        Route::get('applications/{id}/assessment', 'ApplicationController@assessment')->name('applications.assessment');    
        Route::get('applications/{id}/verification', 'ApplicationController@verification')->name('applications.verification');    
        Route::post('applications/{id}/issue-certificate', 'ApplicationController@issueCertificate')->name('applications.issueCertificate');    
        Route::resource('assessments', 'AssessmentController', ['only' => ['store', 'update']]);    
        Route::resource('resources', 'ResourceController', ['only' => ['store']]);    
    });

    Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware(['role:Admin'])->group(function () {
        Route::get('dashboard', "DashboardController@index")->name('dashboard');
        Route::resource('applications', "ApplicationController");
        Route::resource('disability-types', "DisabilityTypeController");
        Route::resource('statuses', "StatusController");
        Route::resource('users', "UserController");
        Route::post('users/check_email', 'UserController@checkEmail')->name('users.check_email');
        Route::resource('roles', "RoleController");
    });
    
});