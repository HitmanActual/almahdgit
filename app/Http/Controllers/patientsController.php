<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Clinic;
use App\Visit;
use Session;
use Image;
use Storage;
use Illuminate\Support\Facades\Input;



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
        $keyword = Input::get('keyword');
        $searchFields = ['phoneOne','phoneTwo'];
        if(isset($keyword)){


            $patients = Patient::where('phoneOne', 'LIKE', "%$keyword%")
            ->orWhere('phoneTwo', 'LIKE', "%$keyword%")
            ->orWhere('patientName', 'LIKE', "%$keyword%")
            ->paginate(5000)->appends('created_at',$keyword);

            
         }else{
            $patients = Patient::orderBy('created_at','desc')->paginate(10);
         }       
        
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
            'phoneOne'=>'required',
            'image'=>'sometimes|mimes:jpeg,jpg,pdf,png,zip',           
        ]);

        $patient = new Patient;
        $patient->patientName = $request->patientName;
        $patient->patientSex = $request->patientSex;
        $patient->dob = $request->dob;
        $patient->phoneOne = $request->phoneOne;
        $patient->phoneTwo = $request->phoneTwo;
        $patient->patientAddress = $request->patientAddress;

        if($request->hasFile('image')){

            //--grab the request
            $image = $request->file('image');
            //--create a fileName
            $fileName = time().'.'.$image->getClientOriginalName();
            //save location
            $location = storage_path('/app/public/images/');
            //resize and save the image
           // Image::make($image)->resize(600,800)->save($location);
            $image->move($location,$fileName);
            //store the image file name in the image column
            $patient->image = $fileName;
        }


        $patient->save();
        $patient->clinics()->sync($request->clinics,false);
        Session::flash('add_patient_success','a patient has been added successfully');
        //redirect
        //return view('patients.show')->withPatient($patient);
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
        $counter = 0;
        $patient = Patient::findOrFail($id);
        //--visit history
        $visits = Visit::withTrashed()->where('patients_id',$id)->orderBy('id', 'desc')->get();
        $counter = Visit::withTrashed()->where('patients_id',$id)->count();
        

        return view('patients.show')->withPatient($patient)
        ->withVisits($visits)->withCounter($counter);
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
            'phoneOne'=>'required', 
            'image'=>'sometimes|mimes:jpeg,jpg,pdf,png,zip',           
        ]);

        $patient = Patient::findOrFail($id);
        $patient->patientName = $request->patientName;
        $patient->patientSex = $request->patientSex;
        $patient->dob = $request->dob;
        $patient->phoneOne = $request->phoneOne;
        $patient->phoneTwo = $request->phoneTwo;
        $patient->patientAddress = $request->patientAddress;

        if($request->hasFile('image')){

            //--grab the request
            $image = $request->file('image');
            //--create a fileName
            $fileName = time().'.'.$image->getClientOriginalName();
            //save location
            $location = storage_path('/app/public/images/');
            //resize and save the image
           // Image::make($image)->resize(600,800)->save($location);
            $image->move($location,$fileName);
            //update the image file name in the image column

            $oldFileName = $patient->image;
            //--update the database
            $patient->image = $fileName; 

            //--delete the old image
            Storage::delete($oldFileName);
        }


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
        Storage::delete($patient->image);
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

    //--get patient's uploaded file from storage directory
    public function docs($id){
        $patient = Patient::findOrFail($id);
        return response()->download(storage_path('app/public/images/'.$patient->image,$patient));

    }



}
