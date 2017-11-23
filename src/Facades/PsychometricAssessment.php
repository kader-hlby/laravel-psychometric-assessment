<?php

namespace Accendo\PsychometricAssessment\Facades;

use Illuminate\Support\Facades\Facade;
use Accendo\PsychometricAssessment\PsychometricAssessment as PsychometricAssessmentClass;

class PsychometricAssessment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PsychometricAssessmentClass::class;
    }
}