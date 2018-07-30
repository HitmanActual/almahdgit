<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Patient;
use App\Clinic;
use App\DoctorVisit;
use Auth;
use Illuminate\Support\Facades\DB;

class DoctorVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,$patient_id)
    {
        //
        $patient = Patient::find($patient_id);
        $clinic_id = Auth::user()->clinic_id;
       

        $doctorVisit = new DoctorVisit();
        $doctorVisit->patient_id = $request->patient_id;
        $doctorVisit->clinic_id = $clinic_id;
        $doctorVisit->doctor_id = Auth::user()->id;
        
        $doctorVisit->head_circumference = $request->head_circumference;
        
        $doctorVisit->weight = $request->weight;
        $doctorVisit->height = $request->height;
        $doctorVisit->dentition = $request->dentition;
        $doctorVisit->development =  $request->development;
        $doctorVisit->present_history_examination = $request->present_history_examination;
        $doctorVisit->t = $request->t;
        $doctorVisit->r = $request->r;
        $doctorVisit->rr = $request->rr;
        $doctorVisit->hr = $request->hr;
        $doctorVisit->diagnosis = $request->diagnosis;
        $doctorVisit->ttt = $request->ttt;
        $doctorVisit->patients()->associate($patient);
        $doctorVisit->save();
        return view('physicians.pediatric.show')->withPatient($patient);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DoctorVisit  $doctorVisit
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorVisit $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DoctorVisit  $doctorVisit
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorVisit $doctorVisit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DoctorVisit  $doctorVisit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorVisit $doctorVisit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DoctorVisit  $doctorVisit
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorVisit $doctorVisit)
    {
        //
    }

    //---add doctor visit--
    public function pediatric_visit($patient_id){

        $patient = Patient::findOrFail($patient_id);  
        return view('physicians.pediatric.pediatricDoctorVisit')->withPatient($patient);
    }

    //--display all doctor visits

    public function patient_displayDoctorVisit($id){

        $patient = Patient::findOrFail($id);
        $doctorVisits = DoctorVisit::where('clinic_id',1)->orderBy('created_at','desc')->get();
                   
        return view('physicians.pediatric.displayVisitHistory')->withDoctorVisits($doctorVisits)->withPatient($patient);

    }

    
}
