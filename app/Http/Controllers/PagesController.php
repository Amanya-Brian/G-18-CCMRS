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
        $getFirstMonth = DB::table('funds')->where('transactionid', '=', 1)->get();
        //dd($getFirstMonth);
        $donations = DB::table('treasuries')->where("date", $getFirstMonth[0]->date)->get();
        $allmonths = DB::table('funds')->get();
        $default = $getFirstMonth;

        $months = DB::table('treasuries')->get();
        return view('pages.Donations',compact(['donations',$donations,'allmonths',
        $allmonths, 'default', $getFirstMonth]));
    }
    public function donationsgraph(Request $request){
       //dd($request);
       $getFirstMonth = DB::table('funds')->where('Month', '=', $request->month)->get();
        //dd($getFirstMonth);
        $donations = DB::table('treasuries')->where("date", $request->month)->get();
        $allmonths = DB::table('funds')->get();
        $default = $getFirstMonth;
       // dd($default[0]->Month);

        $months = DB::table('treasuries')->get();
        return view('pages.Donations',compact(['donations',$donations,'allmonths',
        $allmonths, 'default', $getFirstMonth]));
    }

    public function EnrolGraph(){
        return view('pages.EnrolGraph');
    }

    public function EnrollOfficer(){
        return view('pages.EnrollOfficer');
    }
    protected function count_officers(){
        //return
    }

    public function StoreOfficer(Request $request)
    {


        $miniunm =  DB::table("hospitals")->min('number_of_officers');

        //dd($miniunm);
        //dd($miniunm);
        //loop


        $getHospital = DB::table("hospitals")->where("number_of_officers", "=", $miniunm)->first();
       //dd($getHospital);

                       DB::table('hospitals')->where('hospitalId', '=', $getHospital->hospitalId)->increment("number_of_officers", 1);

                       //assign officer


       //dd($getHospital[0]->?);s
        //here
        if($getHospital){
            $officer = new Officer;
            $officer->username = $request->username;
            $officer->district = $request->district;
            $officer->hospital = $getHospital->hospitalName;
           $officer->save();
            return redirect('/EnrollOfficer')->with('status', 'A new officer has been added to '. $getHospital->hospitalName);

        }

    }

    public function Hierachy(){
        return view('pages.Hierachy');
    }

    public function PatientList(){
        $patients = DB::select('select * from patients');
        $total = DB::table('patients')->count();
        return view('pages.PatientList', ['patients'=>$patients, 'total'=>$total]);
    }

    /*public function Payments(){

        DB::table("funds")->
        return view('pages.Payments');
    }*/

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
