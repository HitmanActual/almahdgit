<?php

namespace App\Http\Controllers;

use App\OrthopedicVisit;
use Illuminate\Http\Request;
use App\Visit;
use App\Patient;
use App\Clinic;
use App\DoctorVisit;
use Auth;
use Illuminate\Support\Facades\DB;

class OrthopedicVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orthoVisits = OrthopedicVisit::all();
        return redirect('physician/orthopedic_patient/'.$patient_id.'/show')->withOrthoVisits($orthoVisits);
        
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

        $orthopedicVisit = new OrthopedicVisit();
        $orthopedicVisit->patient_id = $request->patient_id;
        $orthopedicVisit->clinic_id = $clinic_id;
        $orthopedicVisit->doctor_id = Auth::user()->id;

        $orthopedicVisit->co = $request->co;
        $orthopedicVisit->clinical_finding = $request->clinical_finding;
        $orthopedicVisit->investigations = $request->investigations;
        $orthopedicVisit->treatment = $request->treatment;
        $orthopedicVisit->diagnosis = $request->diagnosis;
        $orthopedicVisit->patients()->associate($patient);
        $orthopedicVisit->save();
        return redirect('physician/orthopedic_patient/'.$patient_id.'/show');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrthopedicVisit  $orthopedicVisit
     * @return \Illuminate\Http\Response
     */
    public function show(OrthopedicVisit $orthopedicVisit)
    {
        //

        return view('physicians.orthopedic.singleVisit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrthopedicVisit  $orthopedicVisit
     * @return \Illuminate\Http\Response
     */
    public function edit(OrthopedicVisit $orthopedicVisit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrthopedicVisit  $orthopedicVisit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrthopedicVisit $orthopedicVisit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrthopedicVisit  $orthopedicVisit
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrthopedicVisit $orthopedicVisit)
    {
        //
    }

    public function orthopedic_visit($patient_id){

        $patient = Patient::findOrFail($patient_id);  
        return view('physicians.orthopedic.orthopedicDoctorVisit')->withPatient($patient);
    }

    public function patient_displayVisits($id){

        $patient = Patient::findOrFail($id);
        $orthopedicVisits = OrthopedicVisit::where('clinic_id',2)->orderBy('created_at','desc')->get();
                   
        return view('physicians.orthopedic.show')->withPatient($patient)->withOrthopedicVisits($orthopedicVisits);
    }
}
