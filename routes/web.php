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
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', "Admin\DashboardController@index")->name('dashboard');

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
        Route::resource('applications', 'ApplicationController', ['only' => ['index', 'store', 'create', 'update']]);    
        Route::get('applications/{id}/assessment', 'ApplicationController@assessment')->name('applications.assessment');    
        Route::get('applications/{id}/verification', 'ApplicationController@verification')->name('applications.verification');    
        Route::post('applications/{id}/issue-certificate', 'ApplicationController@issueCertificate')->name('applications.issueCertificate');    
        Route::resource('assessments', 'AssessmentController', ['only' => ['store']]);    
        Route::resource('resources', 'ResourceController', ['only' => ['store']]);    
    });
    
});
