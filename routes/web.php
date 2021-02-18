<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FundsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentsController;

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

// Route::get('/login','PagesController@login');

Route::get('/login','PagesController@login');

// Route::post('/login/checklogin','PagesController@checklogin');

// Route::get('/login/home','PagesController@successlogin');

// Route::get('/login/logout','PagesController@logout');

Route::get('/EnrollOfficer','PagesController@EnrollOfficer');

Route::post('/storeOfficer', 'PagesController@StoreOfficer');

//change graph
Route::post('/donationsgraph',[PagesController::class , 'donationsgraph'])->name('donationsgraph');

Route::get('/RecordFunds','PagesController@RecordFunds');

Route::post("/storefunds", [FundsController::class , "store"])->name("storefunds");
//Route::post('/storefunds', 'PagesController@StoreFunds');

Route::get('/PatientList','PagesController@PatientList');

Route::get('/Hierachy','PagesController@Hierachy');

Route::get('/EnrolGraph','PagesController@EnrolGraph');

Route::get('/Payments',[PaymentsController::class, 'index'])->name("Payments");
Route::post("/Payments", [PaymentsControlle::class, "Payments"]);

Route::get('/Donations','PagesController@Donations');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
