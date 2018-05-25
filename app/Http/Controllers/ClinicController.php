<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clinic;
use App\Doctor;
use Session;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clinics = Clinic::all();
        return view('clinics.index',compact('clinics'));
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
        //validation
        $this->validate($request,[
            'clinicName'=>'required|max:255',

        ]);

        //store in the database
        $clinic = new Clinic;
        $clinic->clinicName = $request->clinicName;
        $clinic->save();
        Session::flash('add_clinic_success','a clinic has been added successfully');

        //redirect
        return redirect()->route('clinics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctors,$id)
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
        
        //find clinic by id 
        $clinic = Clinic::findOrFail($id);
        return view('clinics.edit',compact('clinics','clinic'));

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
            'clinicName'=>'required|max:255',

        ]);
        //update 
        $clinic = Clinic::findOrFail($id);
        $clinic->clinicName = $request->input('clinicName');
        $clinic->save();
        Session::flash('add_clinic_success','Clinic has been successfully updated');

        //redirect
        return redirect()->route('clinics.index');
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
        $clinic = Clinic::findOrFail($id);
        $clinic->patients()->detach();
        $clinic->delete();
        Session::flash('remove_clinic_success','Clinic has been successfully removed');
        return redirect()->route('clinics.index');
    }
    

}
