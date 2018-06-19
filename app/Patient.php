<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //mass assignment
    protected $fillable = [
        'patientName', 'patientSex', 'patientAddress','phoneOne','phoneTwo','dob','notes',
    ];

    //manyTomany relationship
    public function clinics(){
        return $this->belongsToMany('App\Clinic');
    }
    
    // oneToMany relationship
    public function visits(){
        return $this->hasMany('App\Visit');
    }

    public function pediatric_basic_infos(){
        return $this->hasOne('App\PediatricBasicInfo');
    }
}
