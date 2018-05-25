<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $fillable = [
        'doctorName', 'phoneOne', 'phoneTwo','notes','level_id','clinic_id',
    ];

    

    //relationships

    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function clinic(){
        return $this->belongsTo('App\Clinic');
    }

    public function visits(){
        return $this->hasMany('App\Visit');
    }
}
