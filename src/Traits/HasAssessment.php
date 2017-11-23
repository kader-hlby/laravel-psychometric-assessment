<?php

namespace Accendo\PsychometricAssessment\Traits;

use Accendo\PsychometricAssessment\Models\Assessment;

trait HasAssessment
{
    public function assessments()
    {
        return $this->hasMany(Assessment::class,config('psychometric_assessment.intgratable_id'));
    }
}