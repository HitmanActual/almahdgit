<?php

namespace App\Http\Controllers;



use App\DermaVisit;
use Illuminate\Http\Request;
use App\Visit;
use App\Patient;
use App\Clinic;
use App\DoctorVisit;
use Auth;
use Illuminate\Support\Facades\DB;

class DermaVisitController extends Controller
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

        $dermaVisit = new DermaVisit();
        $dermaVisit->patient_id = $request->patient_id;
        $dermaVisit->clinic_id = $clinic_id;
        $dermaVisit->doctor_id = Auth::user()->id;

        $dermaVisit->allergy = $request->allergy;
        $dermaVisit->diagnosis = $request->diagnosis;
        $dermaVisit->patients()->associate($patient);
        $dermaVisit->save();
        return redirect('physician/derma_patient/'.$patient_id.'/show');
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
        $visit = DermaVisit::findOrFail($id);
        $test = $visit->doctors->doctorName;

        return view('physicians.derma.singleVisit')->withVisit($visit)->withTest($test);
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

    public function derma_visit($patient_id){

        $patient = Patient::findOrFail($patient_id);  
        return view('physicians.derma.dermaDoctorVisit')->withPatient($patient);
    }

    public function patient_displayVisits($id){

        $patient = Patient::findOrFail($id);
        $dermaVisits = DermaVisit::where('clinic_id',2)->orderBy('created_at','desc')->get();
                   
        return view('physicians.derma.show')->withPatient($patient)->withDermaVisits($dermaVisits);
    }
}
