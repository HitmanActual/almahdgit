<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitType extends Model
{
    //
        //mass assignment
        protected $fillable = [
            'visitName',
        ];
        
        // one2many relationship
        public function visits(){
            return $this->hasMany('App\Visit');
        }

        
}
