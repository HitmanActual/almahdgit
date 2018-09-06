<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DermaVisit extends Model
{
    //
    protected $fillable = [
        'patient_id','clinic_id','doctor_id','diagnosis','allergy',
        
    ];

    public function patients(){
        return $this->belongsTo('App\Patient','patient_id');
   }

   public function doctors(){
    return $this->belongsTo('App\Doctor','doctor_id');
    }
}
