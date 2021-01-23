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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index','PagesController@index');

Route::get('/login','PagesController@login');

Route::get('/EnrollOfficer','PagesController@EnrollOfficer');

Route::get('/RecordFunds','PagesController@RecordFunds');

Route::get('/PatientList','PagesController@PatientList');

Route::get('/Hierachy','PagesController@Hierachy');

Route::get('/EnrolGraph','PagesController@EnrolGraph');

Route::get('/Payments','PagesController@Payments');

Route::get('/Donations','PagesController@Donations');
