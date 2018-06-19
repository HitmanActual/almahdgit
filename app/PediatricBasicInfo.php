<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PediatricBasicInfo extends Model
{
    //
    protected $fillable = [
        'consanguinity', 'occupation', 'numberOfSiblings','age','sex','similarCondition','congenitalAnomalies',
        'allergy','dm','dmOne','typeOfLabor','medications','durationOfPregnancy','jaundice','rd','birthWeight',
        'allergyOne','operation','chronicalIllness','trumaAndAccident','infection','patient_id',
    ];
    
    public function patients(){
        return $this->belongsTo('App\Patient','patient_id');
   }
}
