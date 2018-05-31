<?php

namespace App\Http\Controllers;
use App\Patient;
use App\Clinic;
use App\Doctor;
use App\VisitType;
use App\Visit;
use Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

class visitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $keyword = Input::get('keyword');
        if(isset($keyword)){
            $visits = Visit::where('created_at', 'LIKE', "%$keyword%")->paginate(5000)->appends('created_at',$keyword);
         }else{
            $visits = Visit::orderBy('created_at','desc')->paginate(10);
         }       
        return view('visits.index')->withVisits($visits);
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
          //validate
          $this->validate($request,[
            'clinic_id'=>'required|numeric',
            'visitType_id'=>'required|numeric',           
            'doctor_id'=>'required|numeric',
            'price'=>'required|numeric',           
        ]);
        //store
        $patient = Patient::find($patient_id);
        $visit = new Visit();
        $visit->clinic_id = $request->clinic_id;
        $visit->visitType_id= $request->visitType_id;
        $visit->price = $request->price;
        $visit->doctor_id = $request->doctor_id;
        $visit->patients()->associate($patient);
        $visit->save();

        Session::flash('add_visit_success','a visit has been added successfully');
        return redirect()->route('patients.show',$patient->id);
        
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
        $visit = Visit::findOrFail($id);

        $visitTypes = VisitType::all();
        $visitTypesLooper = [];
        
        foreach($visitTypes as $visitType){

            $visitTypesLooper[$visitType->id] = $visitType->visitName;
        }
        
        return view('visits.edit')->withVisit($visit)->withVisitTypes($visitTypesLooper);
        
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
        $visit = Visit::findOrFail($id);
        $visit->visitType_id = $request->visitType_id;
        $visit->price = $request->price;
        $visit->save();
        return redirect()->route('patients.show',$visit->Patients->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $visit = Visit::findOrFail($id);
        return view('visits.delete')->withVisit($visit);
    }

    public function destroy($id){
        $visit = Visit::findOrFail($id);
        $visit->delete();
        return redirect()->route('patients.show',$visit->Patients->id);
        
    }



    public function patient_visit($id){

        $patient = Patient::findOrFail($id);
        $visitTypes = VisitType::all();
                   
        return view('visits.visit')->withPatient($patient)->withVisitTypes($visitTypes);
    }

    //--fetch doctors based on selected clinic when visit occur
    public function findDoctorName(Request $req){

        $data = Doctor::select('doctorName','id')->where('clinic_id',$req->id)->get();
        return response()->json($data);
    }



}
