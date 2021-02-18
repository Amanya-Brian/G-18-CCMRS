<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FundsController extends Controller
{
    //

    public function index(){
        echo 'AM HERE';

    }
    protected function getMonth($array , $number){
        foreach($array as $key=>$value){
            if((int)$value == (int)$number){
                return $key;
            }

        }

    }
    public function store(Request $request){
        //dd($request);
        $this->validate($request,[
            'amount'=>'required',
            'month'=>'required'
        ]);

        $explode =  explode('-',$request->month)[1];
        //dd($explode);\
        $mapper = [
            "January"=>'1', 'February'=>'2', 'March'=>'3','April'=>'4','May'=>'5','June'=>'6',
            'July'=>'7','August'=>'8', 'September'=>'9','October'=>'10','November'=>'11',
            'December'=>'12'
        ];
        $month = $this->getMonth($mapper, $explode);
        //dd($month);

        //insert into tbale
      //check into
        if(count(DB::table('funds')->where('Month','=', $month)->get())){
            //dd("AM HERE");
            //true
            $totalMonth = DB::table('funds')->where('Month', '=', $month)->get();
            //dd($totalMonth);
            $totalAmount = (int)$totalMonth[0]->Amount + (int)$request->amount;
            
            //insert
            DB::update('update funds set Amount = ? where Month = ?', [$totalAmount, $month]);

            //insert into transaction table
            DB::insert('insert into treasuries (date, amount) values (?, ?)', [$month, $request->amount]);
            

            //r
            return redirect('/RecordFunds')->with('status', 'Monthly funds Have Been inserted');


        }
        else{

                        //insert into funds
                        DB::insert('insert into funds (Month, Amount) values (?, ?)', [$month, $request->amount]);
                        //insert into transaction table
             DB::insert('insert into treasuries (date, amount) values (?, ?)', [$month, $request->amount]);

             return redirect('/RecordFunds')->with('status', 'Monthly funds Have Been inserted');



        }
       //
        

    }
}
