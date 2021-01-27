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


Route::get('/','PagesController@index');

//Route::get('/login','PagesController@login');

Route::post('/login/checklogin','PagesController@checklogin');

Route::get('/login/home','PagesController@successlogin');

Route::get('/login/logout','PagesController@logout');

Route::get('/EnrollOfficer','PagesController@EnrollOfficer');

Route::post('/storeOfficer', 'PagesController@StoreOfficer');

Route::get('/RecordFunds','PagesController@RecordFunds');

Route::post('/storefunds', 'PagesController@StoreFunds');

Route::get('/PatientList','PagesController@PatientList');

Route::get('/Hierachy','PagesController@Hierachy');

Route::get('/EnrolGraph','PagesController@EnrolGraph');

Route::get('/Payments','PagesController@Payments');

Route::get('/Donations','PagesController@Donations');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
