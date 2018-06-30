<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    //
    protected $fillable = ['prescriptionName','patient_id','responsible','clinic_id'];

    public function patients(){
        return $this->belongsTo('App\Patient','patient_id');
    }
}
