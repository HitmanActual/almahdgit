<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Patient;
use App\Clinic;
use App\Prescription;
use Auth;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
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
    public function store(Request $request, $patient_id)
    {
        //
        $patient = Patient::find($patient_id);
        $clinic_id = Auth::user()->clinic_id;
        

        $prescription = new Prescription();
        $prescription->prescriptionName = $request->prescriptionName;
        $prescription->patient_id = $request->patient_id;
        $prescription->clinic_id = $clinic_id;
        $prescription->responsible = Auth::user()->doctorName;
        $prescription->patients()->associate($patient);
        $prescription->save();
        return view('physicians.pediatric.show')->withPatient($patient);
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

    public function patient_prescription($patient_id){

        

        $patient = Patient::findOrFail($patient_id);  
        return view('physicians.pediatric.pediatricPrescription')->withPatient($patient);
    }



}
