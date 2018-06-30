<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Patient;
use App\Clinic;
use App\PediatricBasicInfo;
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
          $basicInfo = PediatricBasicInfo::all();

          $visits = Visit::where('clinic_id',$clinicId)->orderBy('created_at','desc')->get();

          return view('pediatric_physician')->withVisits($visits)->withBasicInfo($basicInfo);
        
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
        $basicInfo = new PediatricBasicInfo();
        $basicInfo->consanguinity = $request->consanguinity;
        $basicInfo->occupation = $request->occupation;
        $basicInfo->numberOfSiblings = $request->numberOfSiblings;
        $basicInfo->age = $request->age;
        $basicInfo->sex = $request->sex;
        $basicInfo->similarCondition = $request->similarCondition;
        $basicInfo->congenitalAnomalies = $request->congenitalAnomalies;
        $basicInfo->allergy = $request->allergy;
        $basicInfo->dm = $request->dm;
        $basicInfo->dmOne = $request->dmOne;
        $basicInfo->typeOfLabor = $request->typeOfLabor;
        $basicInfo->medications = $request->medications;
        $basicInfo->durationOfPregnancy = $request->durationOfPregnancy;
        $basicInfo->jaundice = $request->jaundice;
        $basicInfo->rd = $request->rd;
        $basicInfo->birthWeight = $request->birthWeight;
        $basicInfo->allergyOne = $request->allergyOne;
        $basicInfo->operation = $request->operation;
        $basicInfo->chronicalIllness = $request->chronicalIllness;
        $basicInfo->trumaAndAccident = $request->trumaAndAccident;
        $basicInfo->infection = $request->infection;
        $basicInfo->typeOfFeeding = $request->typeOfFeeding;
        $basicInfo->ironSup = $request->ironSup;
        $basicInfo->nutrittionalDisorder = $request->nutrittionalDisorder;
        $basicInfo->onsetOfweaning = $request->onsetOfweaning;
        $basicInfo->vitDCaSupp = $request->vitDCaSupp;

        $basicInfo->patient_id = $request->patient_id;

        $basicInfo->patients()->associate($patient);

        $basicInfo->save();

        //Session::flash('add_visit_success','a visit has been added successfully');
        //return redirect()->route('patients.show',$patient->id);
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
        $pediatricBasicInfo = PediatricBasicInfo::findOrfail($id);
        return view('physicians.pediatric.edit')->withPediatricBasicInfo($pediatricBasicInfo);
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
        
        $basicInfo = PediatricBasicInfo::findOrfail($id);
        $patient = Patient::findOrFail($basicInfo->patient_id);
        $basicInfo->consanguinity = $request->consanguinity;
        $basicInfo->occupation = $request->occupation;
        $basicInfo->numberOfSiblings = $request->numberOfSiblings;
        $basicInfo->age = $request->age;
        $basicInfo->sex = $request->sex;
        $basicInfo->similarCondition = $request->similarCondition;
        $basicInfo->congenitalAnomalies = $request->congenitalAnomalies;
        $basicInfo->allergy = $request->allergy;
        $basicInfo->dm = $request->dm;
        $basicInfo->dmOne = $request->dmOne;
        $basicInfo->typeOfLabor = $request->typeOfLabor;
        $basicInfo->medications = $request->medications;
        $basicInfo->durationOfPregnancy = $request->durationOfPregnancy;
        $basicInfo->jaundice = $request->jaundice;
        $basicInfo->rd = $request->rd;
        $basicInfo->birthWeight = $request->birthWeight;
        $basicInfo->allergyOne = $request->allergyOne;
        $basicInfo->operation = $request->operation;
        $basicInfo->chronicalIllness = $request->chronicalIllness;
        $basicInfo->trumaAndAccident = $request->trumaAndAccident;
        $basicInfo->infection = $request->infection;
        $basicInfo->typeOfFeeding = $request->typeOfFeeding;
        $basicInfo->ironSup = $request->ironSup;
        $basicInfo->nutrittionalDisorder = $request->nutrittionalDisorder;
        $basicInfo->onsetOfweaning = $request->onsetOfweaning;
        $basicInfo->vitDCaSupp = $request->vitDCaSupp;

       

        $basicInfo->save();
        return view('physicians.pediatric.show')->withPatient($patient);

     


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

    public function archive($id){
        $visit = Visit::findOrFail($id);
        $visit->delete();
        return redirect()->route('pediatric.dashboard');

    }

   

}
