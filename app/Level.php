<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    //mass assignment
    protected $fillable = [
        'levelName',
    ];
    
    // one2many relationship
    public function doctor(){
        return $this->hasMany('App\Doctor');
    }

}
