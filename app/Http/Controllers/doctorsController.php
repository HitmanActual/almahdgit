<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Level;
use App\Clinic;
use Session;

class doctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $doctors = Doctor::orderBy('id','desc')->paginate(10);

        return view('doctors.index')->withDoctors($doctors);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all(); //generate  level drop downlist dynamiclly
        $clinics = Clinic::all();// generate clinci drop downlist dynamiclly
        return view('doctors.create')->withLevels($levels)->withClinics($clinics);
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
            'doctorName'=>'required|max:255',
            'phoneOne'=>'required|numeric',
            
            'level_id'=>'required|numeric',
            'clinic_id'=>'required|numeric',           
        ]);

        //store
        $doctor = new Doctor;
        $doctor->doctorName= $request->doctorName;
        $doctor->phoneOne= $request->phoneOne;
        $doctor->phoneTwo= $request->phoneTwo;
        $doctor->notes= $request->notes;
        $doctor->level_id = $request->level_id;
        $doctor->clinic_id = $request->clinic_id;
        $doctor->save();
        
        Session::flash('add_doctor_success','a doctor has been added successfully');

        //redirect
        return redirect()->route('doctors.show',$doctor->id);


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
        $doctor = Doctor::findOrFail($id);
        return view('doctors.show')->withDoctor($doctor);
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
        $levels = Level::all(); //generate  level drop downlist dynamiclly
        $levelsLooper = [];
        foreach($levels as $level){

            $levelsLooper[$level->id] = $level->levelName;
        }

        $clinics = Clinic::all();// generate clinci drop downlist dynamiclly
        $clinicLooper=[];
        foreach($clinics as $clinic){
            $clinicLooper[$clinic->id] = $clinic->clinicName;
        }

        $doctor = Doctor::findOrFail($id);
        return view('doctors.edit')->withDoctor($doctor)->withClinics($clinicLooper)->withLevels($levelsLooper);
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
            'doctorName'=>'required|max:255',
            'phoneOne'=>'required|numeric',
            
            'level_id'=>'required|numeric',
            'clinic_id'=>'required|numeric',           
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->doctorName= $request->doctorName;
        $doctor->phoneOne= $request->phoneOne;
        $doctor->phoneTwo= $request->phoneTwo;
        $doctor->notes= $request->notes;
        $doctor->level_id = $request->level_id;
        $doctor->clinic_id = $request->clinic_id;
        $doctor->save();

        Session::flash('update_doctor_success','a doctor has been updated successfully');

        //redirect
        return redirect()->route('doctors.show',$doctor->id);

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
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        Session::flash('remove_doctor_success','a Doctor has been successfully removed');
        return redirect()->route('doctors.index');
    }

    //display doctors in a specific clinic
    public function clinic_doctors($id)
    {
        //
        $clinics = Clinic::with('doctor')->orderBy('id','asc')->get();
        $doctors = Doctor::orderBy('id','desc')->where('clinic_id',$id)->paginate(10);

        return view('doctors.index')->withDoctors($doctors);
    }

 
}
