<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use auth;

class PaymentsController extends Controller
{

    public function Payments(Request $request)
    {
        //Input::post('name');
        //Input::post('surname');
        //dd($request);
        // $month=$request->input('month');
        // $year=$request->input('year');
        // return view('pages.Payments')->with($request);




        // /*  function pay()
        //     {
        //         $startdate=Carbon::now();
        //         $paydate=$startdate->addDays(30);

        //     }*/


        // if($request)
        // {
        //  $sum=DB::table('treasury')
        //     ->whereYear('created_at','$request->year')
        //     ->whereMonth('created_at','$request->month')
        //     ->sum('amount');

        //     if($sum>100000000)
        //     {
        //         function distributions(){
        //             $remainder=$sum-100000000;
        //             if($remainder>0)
        //             {
        //                 $answers= $request->get('option');
        //                 foreach ($answers as  $answer)
        // {
        //           $answer =  new Answer();
        //           $answer->question_id = $qId;
        //           $answer->answer = $answer;
        //           $answer ->customer_id = $customerId;
        //           $answer->director_pay->$director_pay=5000000 + (0.05*$remainder);
        //           $answer->sup_pay->$sup_pay=(0.5*$director_pay);
        //           $answer->admin_pay->$admin_pay=(0.75*$sup_pay);
        //           $answer->officer_pay->$officer_pay=(1.6*$admin_pay);
        //           $answer->senior_pay->$senior_pay=$officer_pay + (0.06*$officer_pay);
        //           $answer->hofficer_pay->$hofficer_pay=$officer_pay + (0.035*$officer_pay);
        //           $answer->save();
        // }

        //             }


        //         else {
        //             echo "Error funds are less than shs.100,000,000";
        //         }
        //     }


        //     }

        // }
        // $Roles=array("Director","Administrator","Superintendent","Senior_Health_Officer","
        // Head_Health_Officer");


       return view('pages.Payments');



    }
                        

    protected   function distributions($Amount1 , $Amount2){
        return (int)$Amount1 - (int)$Amount2;
        

        }
    public function index(){
       
        //
        $allMonths = DB::table("funds")->where("Amount", ">",  100000000)->get();
        if(count($allMonths)){
            $month = $allMonths[0]->Month;

            $balance = $this->distribution($allMonths[0]->Amount, 100000000);


            

           // {
                //  $sum=DB::table('treasury')
                //     ->whereYear('created_at','$request->year')
                //     ->whereMonth('created_at','$request->month')
                //     ->sum('amount');
        
                //     if($sum>100000000)
                //     {
                //         function distributions(){
                //             $remainder=$sum-100000000;
                //             if($remainder>0)
                //             {
                //                 $answers= $request->get('option');
                //                 foreach ($answers as  $answer)
                // {
                //           $answer =  new Answer();
                //           $answer->question_id = $qId;
                //           $answer->answer = $answer;
                //           $answer ->customer_id = $customerId;
                //           $answer->director_pay->$director_pay=5000000 + (0.05*$remainder);
                //           $answer->sup_pay->$sup_pay=(0.5*$director_pay);
                //           $answer->admin_pay->$admin_pay=(0.75*$sup_pay);
                //           $answer->officer_pay->$officer_pay=(1.6*$admin_pay);
                //           $answer->senior_pay->$senior_pay=$officer_pay + (0.06*$officer_pay);
                //           $answer->hofficer_pay->$hofficer_pay=$officer_pay + (0.035*$officer_pay);
                //           $answer->save();
                // }
        
                //             }
        
        
                //         else {
                //             echo "Error funds are less than shs.100,000,000";
                //         }
                //     }
        
        
                //     }
        
                // }
                // $Roles=array("Director","Administrator","Superintendent","Senior_Health_Officer","
                // Head_Health_Officer");

            return view('pages.Payments', ['allmonths'=>$allMonths]);

        }
        else{
        
            $array = array();
            return view('pages.Payments', ['allmonths'=>$array]);

        }



    }

    /*function pay()
    {
        $startdate=Carbon::now();
        $paydate=$startdate->addDays(30);




        if($startdate->eq($paydate))
        {
        $sum=DB::table('donations')
            ->whereYear('created_at','2021')
            ->whereMonth('created_at','02')
            ->sum('amount');
            if($sum>10000)
            {
                DB::table('officers')
                ->orderby('id')
                ->chunkById(100,function($officers)
                {
                    foreach($officers as $officer)
                    {
                        DB::table('payments')
                        ->insert(['name'=>$officer->name,'salary_paid'=>$officer->salary,'status'=>'paid']);
                    }
                });
            }

        }
        $payments =payment::all();
       return view('admin.payment',['payments'=>$payments]);


    }*/
}
