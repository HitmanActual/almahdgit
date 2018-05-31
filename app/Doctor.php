<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Authenticatable
{
    use Notifiable;
    protected $guard = 'doctor';
    //
    protected $fillable = [
        'doctorName', 'phoneOne', 'phoneTwo','notes','level_id','clinic_id','email','password',
    ];

    protected $hidden = [
        'password', 'remember_token',
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
