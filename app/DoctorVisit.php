<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorVisit extends Model
{
     //mass assignment
     protected $fillable = [
        'patient_id','clinic_id','doctor_id','head_circumference','weight','height',
        'dentition','development','present_history_examination','t','r','rr','hr','diagnosis',
        'ttt',
        
    ];

    public function patients(){
        return $this->belongsTo('App\Patient','patient_id');
   }

}
