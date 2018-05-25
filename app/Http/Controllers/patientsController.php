<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Clinic;
use App\Visit;
use Session;


class patientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $patients = Patient::orderBy('id','desc')->paginate(10);
        return view('patients.index')->withPatients($patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $clinics = Clinic::all();

        return view('patients.create')->withClinics($clinics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //validate
         $this->validate($request,[
            'patientName'=>'required|max:255',
            'patientSex'=>'required',
            'dob'=>'required',
            'phoneOne'=>'required|numeric',           
        ]);

        $patient = new Patient;
        $patient->patientName = $request->patientName;
        $patient->patientSex = $request->patientSex;
        $patient->dob = $request->dob;
        $patient->phoneOne = $request->phoneOne;
        $patient->phoneTwo = $request->phoneTwo;
        $patient->patientAddress = $request->patientAddress;
        $patient->save();
        $patient->clinics()->sync($request->clinics,false);
        Session::flash('add_patient_success','a patient has been added successfully');
        //redirect
        return view('patients.show')->withPatient($patient);

        

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
        $patient = Patient::findOrFail($id);
        //--visit history
        $visits = Visit::where('patients_id',$id)->orderBy('id', 'desc')->get();
        $counter = Visit::where('patients_id',$id)->count();

        return view('patients.show')->withPatient($patient)->withVisits($visits)->withCounter($counter);
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
        $patient = Patient::findOrFail($id);
        $clinics = Clinic::all();
        $clinics2 = array();

        foreach($clinics as $clinic){

            $clinics2[$clinic->id] = $clinic->clinicName;
        }
        return view('patients.edit')->withPatient($patient)->withClinics($clinics2);
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
        //validate
        $this->validate($request,[
            'patientName'=>'required|max:255',
            'patientSex'=>'required',
            'dob'=>'required',
            'phoneOne'=>'required|numeric',           
        ]);

        $patient = Patient::findOrFail($id);
        $patient->patientName = $request->patientName;
        $patient->patientSex = $request->patientSex;
        $patient->dob = $request->dob;
        $patient->phoneOne = $request->phoneOne;
        $patient->phoneTwo = $request->phoneTwo;
        $patient->patientAddress = $request->patientAddress;
        $patient->save();
        $patient->clinics()->sync($request->clinics,true);
        Session::flash('add_patient_success','a patient has been added successfully');
        //redirect
        return redirect()->route('patients.show',$patient->id);
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
        $patient = Patient::find($id);
        $patient->clinics()->detach();
        $patient->delete();
        Session::flash('remove_patient_success','a Patient has been successfully removed');
        return redirect()->route('patients.index');

    }


    //get all patients from a specific clinic
    public function clinic_patients($id)
    {
        //
        $clinic = Clinic::findOrFail($id);        
        return view('patients.clinic_patient')->withClinic($clinic);
    }



}
