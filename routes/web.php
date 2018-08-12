<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['auth']],function(){

   

    Route::get('/', 'PagesController@getIndex');

    Route::resource('clinics', 'ClinicController');
    Route::resource('doctors', 'doctorsController');
    Route::resource('patients', 'patientsController');


    //clinics and it's doctors
    Route::get('/clinic_doctors/{clinic_id}',[
        'uses'=>'doctorsController@clinic_doctors',
        'as'=>'clinic_doctors'
    ]);

    //clinics and it's patients
    Route::get('/clinic_patient/{patient_id}',[
        'uses'=>'patientsController@clinic_patients',
        'as'=>'clinic_patients'
    ]);

    //-for security concern get uploaded image from storage NOT THE PUBLIC directory
    Route::get('/docs/{id}','patientsController@docs');

   


    //--assign a visit to a specific patient
    Route::get('visits/patient/{patient_id}',['uses'=>'visitsController@patient_visit','as'=>'visit']);
    //patient visits

    Route::post('visits/{patient_id}',['uses'=>'visitsController@store','as'=>'visits.store']);
    Route::get('visits/{id}/show',['uses'=>'visitsController@show','as'=>'visits.show']);
    Route::get('visits/{id}/edit',['uses'=>'visitsController@edit','as'=>'visits.edit']);
    Route::put('visits/{id}',['uses'=>'visitsController@update','as'=>'visits.update']);
    Route::delete('visits/{id}',['uses'=>'visitsController@destroy','as'=>'visits.destroy']);
    Route::get('visits/{id}/delete',['uses'=>'visitsController@delete','as'=>'visits.delete']);

    Route::get('visits',['uses'=>'visitsController@index','as'=>'visits.index']);

    Route::get('/visit_doc/{id}','visitsController@docs');

    //--fetch doctors based on selected clinic when visit occur
    Route::get('clinicDoctors',[
        'uses'=>'visitsController@findDoctorName',
        'as'=>'clinicDoctors'
    ]);
});










Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('physician')->group(function(){

    Route::get('/login','Auth\physicianLoginController@showLoginForm')->name('physician.login');
    Route::post('/login','Auth\physicianLoginController@login')->name('physician.login.submit');

    Route::group(['middleware' =>'auth:pediatric'], function () {

        Route::get('/pediatric', 'pediatricPhysicianController@index')->name('pediatric.dashboard');
        Route::get('pediatric_patient/{id}/show',['uses'=>'pediatricPhysicianController@show','as'=>'pediatric_patient.show']);

        //--assign a pediatric medical info to a specific patient
        Route::get('pediatric_patient/add_basic_info/{patient_id}/',['uses'=>'pediatricPhysicianController@basic_info','as'=>'add_basic_info']);
        Route::get('pediatric_patient/basic_info/{id}/edit',['uses'=>'pediatricPhysicianController@edit','as'=>'edit_basic_info']);
        Route::put('pediatric_patient/{id}',['uses'=>'pediatricPhysicianController@update','as'=>'edit_basic_info.update']);
        Route::post('add_basic_info/{patient_id}',['uses'=>'pediatricPhysicianController@store','as'=>'add_basic_info.store']);
        
        //-archiving visits!
        Route::get('pediatric_patient/{id}/archive',['uses'=>'pediatricPhysicianController@archive','as'=>'pediatric_patient.archive']);

        //-- assign pediatric prescription to a patient
        Route::get('pediatric/patient/{patient_id}/prescription',['uses'=>'PediatricPrescriptionController@patient_prescription','as'=>'prescription']);
        Route::post('pediatricPrescription/{patient_id}',['uses'=>'PediatricPrescriptionController@store','as'=>'pediatricPrescription.store']);
        Route::get('patient/prescriptions/{patient_id}',['uses'=>'PediatricPrescriptionController@patient_displayPrescription','as'=>'pediatricPrescription.display']);
        Route::get('patient/prescription/{id}/show',['uses'=>'PediatricPrescriptionController@show','as'=>'single.show']);

        //--assign pediatric visit to patient
        Route::get('pediatric/patient/{patient_id}/add_doctor_visit',['uses'=>'DoctorVisitController@pediatric_visit','as'=>'pediatric_visit']);
        Route::post('pediatricVisit/{patient_id}',['uses'=>'DoctorVisitController@store','as'=>'pediatricVisit.store']);
        Route::get('patient/visit_history/{id}',['uses'=>'DoctorVisitController@patient_displayDoctorVisit','as'=>'visit_history']);


    });

    //--orthopic doctors interface
    Route::group(['middleware' =>'auth:orthopedic'], function () {

    Route::get('/orthopedic', 'orthopedicPhysicianController@index')->name('orthopedic.dashboard');
    Route::get('orthopedic_patient/{id}/show',['uses'=>'orthopedicPhysicianController@show','as'=>'orthopedic_patient.show']);
    Route::get('orthopedic_patient/{id}/archive',['uses'=>'orthopedicPhysicianController@archive','as'=>'orthopedic_patient.archive']);
    Route::get('orthopedic/patient/{patient_id}/add_doctor_visit',['uses'=>'OrthopedicVisitController@orthopedic_visit','as'=>'orthopedic_visit']);
    Route::post('orthopedicVisit/{patient_id}',['uses'=>'OrthopedicVisitController@store','as'=>'orthopedicVisit.store']);
    Route::get('orthopedic_patient/{id}/show_visit',['uses'=>'OrthopedicVisitController@show','as'=>'orthopedic_visit.show']);



    });
});

