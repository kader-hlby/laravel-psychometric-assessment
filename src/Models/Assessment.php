<?php

namespace Accendo\PsychometricAssessment\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = "psychometric_assessment_assessments";

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }
    
    public function scopeCompleted($quere){
        return $quere->where('status','completd');
    }
}
