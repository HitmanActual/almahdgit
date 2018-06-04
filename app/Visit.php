<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    //
        //mass assignment
        protected $fillable = [
            'clinic_id','patient_id','visitType_id','price','doctor_id','image',
        ];
        
        // one2many relationship
        public function visitTypes(){
            return $this->belongsTo('App\VisitType','visitType_id');
        }

         // one2many relationship
        public function clinics(){
            return $this->belongsTo('App\Clinic','clinic_id');
        }

        // one2many relationship
        public function patients(){
             return $this->belongsTo('App\Patient','patients_id');
        }

        public function doctors(){
            return $this->belongsTo('App\Doctor','doctor_id');
       }
}
