<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treasury;
use App\Models\Officer;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;

class PagesController extends Controller
{
    public function login(){
        return view('layouts.app');
    }
    /* public function checklogin(Request $request)
    {
     $request->validate([
      'username'   => 'required|string',
      'password'  => 'required|alphaNum|min:5'
     ]);

     $user_data = array(
      'username'  => $request->get('username'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data))
     {
      return redirect('/home');
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }

    }
    public function successlogin()
    {
     return view('home');
    }
    public function logout()
    {
     Auth::logout();
     return redirect('pages.login');
    } */

    public function index(){
        return view('pages.index');
    }

    public function Donations(){
        return view('pages.Donations');
    }

    public function EnrolGraph(){
        return view('pages.EnrolGraph');
    }
    
    public function EnrollOfficer(){
        return view('pages.EnrollOfficer');
    }

    public function StoreOfficer(Request $request)
    {
        $officer = new Officer;
        $officer->username = $request->username;
        $officer->district = $request->district;
        $officer->hospital = $request->hospital;
        $officer->save();
        return redirect('/EnrollOfficer')->with('status', 'A new officer has been added.');
    }

    public function Hierachy(){
        return view('pages.Hierachy');
    }

    public function PatientList(){
     /*   $patients = DB::select('select * from patients');
        return view('pages.PatientList', ['patients'=>$patients]); */
    }

    public function Payments(){
        return view('pages.Payments');
    }

    public function RecordFunds(){
        return view('pages.RecordFunds');
    }

    public function StoreFunds(Request $request)
    {
        $funds = new Treasury;
        $funds->date = date('M');
        $funds->amount = $request->amount;
        $funds->save();
        return redirect('/RecordFunds')->with('status', 'Monthly funds Have Been inserted');
    }

}
