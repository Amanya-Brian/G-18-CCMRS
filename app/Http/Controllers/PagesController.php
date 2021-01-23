<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
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
