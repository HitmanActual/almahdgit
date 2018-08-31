<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Patient;
use App\Clinic;
use App\PediatricBasicInfo;
use App\OrthopedicVisit;

use Auth;
use Illuminate\Support\Facades\DB;

class orthopedicPhysicianController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:orthopedic');
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


        return view('orthopedic_physician')->withVisits($visits)->withBasicInfo($basicInfo);
    }

    public function show($id){

        $patient = Patient::findOrfail($id);
        //pediatric clinic = 1 
        //$clinicId = DB::table('clinic_patient')->where('clinic_id',1)->value('clinic_id');
        //-pull the clinic id dynamically
        $clinicId = Auth::user()->clinic_id;
        $orthoVisits = OrthopedicVisit::orderBy('created_at','desc')->get();

        return view('physicians.orthopedic.show')->withPatient($patient)->withClinicId($clinicId)->withOrthoVisits($orthoVisits);
    }

    public function archive($id){
        $visit = Visit::findOrFail($id);
        $visit->delete();
        return redirect()->route('orthopedic.dashboard');

    }

    public function docx($id){
        $patient = Patient::findOrFail($id);
        return response()->download(storage_path('app/public/images/'.$patient->image,$patient));

    }
}
