<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ChartJSController;

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
oute::get('/chart-js','ChartJSController@index');



Route::post('/login/checklogin','PagesController@checklogin');

Route::get('/login/home','PagesController@successlogin');

Route::get('/login/logout','PagesController@logout');

Route::get('/EnrollOfficer','PagesController@EnrollOfficer');

Route::post('/storeOfficer', 'PagesController@StoreOfficer');

Route::get('/RecordFunds','PagesController@RecordFunds');

Route::post('/storefunds', 'PagesController@StoreFunds');

Route::get('/PatientList','PagesController@PatientList');

Route::get('/Hierachy','PagesController@Hierachy');

//Route::get('/EnrolGraph','PagesController@EnrolGraph');

Route::get('/Payments','PagesController@Payments');

//Route::get('/EnrolGraph', 'PatientController@index');

Route::get('/EnrolGraph', [PatientController::class, 'index'])->name('pages.EnrolGraph');

/*Route::get('/EnrolGraph',function(){
    $chart = (new LarapexChart)->setTitle('Users')
            ->setXAxis(['Active users','Blocked users'])
            ->setDataset([100,50]);
    return view('pages.EnrolGraph',compact('chart'));
});*/



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
