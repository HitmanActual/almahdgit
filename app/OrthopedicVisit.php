<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrthopedicVisit extends Model
{
    
     //mass assignment
     protected $fillable = [
        'patient_id','clinic_id','doctor_id','co','clinical_finding','investigations',
        'treatment','diagnosis',
        
    ];

    public function patients(){
        return $this->belongsTo('App\Patient','patient_id');
   }
}
