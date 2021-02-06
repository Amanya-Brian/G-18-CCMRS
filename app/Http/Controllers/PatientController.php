<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Charts\PatientChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
       /* $patients = Patient::where(DB::raw("(DATE_FORMAT(Enrollment_Date,'%Y'))"),date('Y'))->get();
        $chart= new PatientChart;
        $chart = Charts::database($patients,'line','highcharts')
                    ->title("Enrollment Graph") 
                    ->elementlabel("Covid Patients")
                    ->dimensions(1000,500)
                    ->responsive(false)
                    ->groupByMonth(date('Y'),true);       

        return view('pages.EnrolGraph', ['chart'=>$chart]);
        //return Patient::get();*/
       /* $patients = Patient::select(\DB::raw("COUNT(*) as count"))
                            ->whereYear('Enrollment_Date', date('Y'))
                            ->groupBy(\DB::raw("Month('Enrollment_Date')"))
                            ->pluck('count');
        $chart= new PatientChart;
        $chart->labels(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']);
        $chart->dataset('Covid Patients Enrollment Chart','line',$patients)->options([
            'fill'=>'true',
            'borderColor' => '#51C1C0'
        ]);
                       
        dd($chart);

        return view('pages.EnrolGraph',['chart'=>$chart]);*/
        
        $year = ['2015','2016','2017','2018','2019','2020'];

        $patient = [];
        foreach ($year as $key => $value) {
            $patient[] = Patient::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
        }

    	return view('pages.EnrolGraph')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('patient',json_encode($patient,JSON_NUMERIC_CHECK));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($patient)
    {
       return Patient::where('id',$patient)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
