<?php

namespace Accendo\PsychometricAssessment\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $table = "psychometric_assessment_tools";

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function psychometric()
    {
        return $this->belongsTo(Psychometric::class);
    }

    public function scopeCute($quere)
    {
        return $quere->where('assessment_provider','cute');
    }

    public function scopeKnolskape($quere)
    {
        return $quere->where('assessment_provider','knolskape');
    }
}
