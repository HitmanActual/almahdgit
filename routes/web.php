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
        Route::post('add_basic_info/{patient_id}',['uses'=>'pediatricPhysicianController@store','as'=>'add_basic_info.store']);
    });

    







    Route::group(['middleware' =>'auth:orthopedic'], function () {

    Route::get('/orthopedic', 'orthopedicPhysicianController@index')->name('orthopedic.dashboard');
    });
});

