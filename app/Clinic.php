<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    //
    protected $fillable = [
        'clinicName',
    ];

    protected $table = 'clinics';

    // oneToMany relationship
    public function doctor(){
        return $this->hasMany('App\Doctor');
    }

    // ManyToMany relationship
    public function patients(){
        return $this->belongsToMany('App\Patient');
    }


    // oneToMany relationship
    public function visits(){
        return $this->hasMany('App\Visit');
    }
}
