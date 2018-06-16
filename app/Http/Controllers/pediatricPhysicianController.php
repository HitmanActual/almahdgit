<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Patient;
use Auth;
use Illuminate\Support\Facades\DB;

class pediatricPhysicianController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:pediatric');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          //get the clinic id of the authinticated doctor
          $clinicId = Auth::user()->clinic_id;

          $visits = Visit::where('clinic_id',$clinicId)->orderBy('created_at','desc')->get();

          return view('pediatric_physician')->withVisits($visits);
        
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $patient = Patient::findOrfail($id);
        //pediatric clinic = 1 
        //$clinicId = DB::table('clinic_patient')->where('clinic_id',1)->value('clinic_id');
        //-pull the clinic id dynamically
        $clinicId = Auth::user()->clinic_id;
        return view('physicians.pediatric.show')->withPatient($patient)->withClinicId($clinicId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function basic_info($id){

        $patient = Patient::findOrFail($id);
        
                   
        return view('physicians.pediatric.basic_info')->withPatient($patient);
    }

}
