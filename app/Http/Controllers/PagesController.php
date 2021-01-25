<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class PagesController extends Controller
{
    public function login(){
        return view('pages.login');
    }
    public function checklogin(Request $request)
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
     return redirect('login');
    }
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

    public function Hierachy(){
        return view('pages.Hierachy');
    }

    public function PatientList(){
        return view('pages.PatientList');
    }

    public function Payments(){
        return view('pages.Payments');
    }

    public function RecordFunds(){
        return view('pages.RecordFunds');
    }


}
