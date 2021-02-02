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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function login(){
        return view('layouts.app');


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
        $patients = DB::select('select * from patients');
        $total = DB::table('patients')->count();
        return view('pages.PatientList', ['patients'=>$patients, 'total'=>$total]); 
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
