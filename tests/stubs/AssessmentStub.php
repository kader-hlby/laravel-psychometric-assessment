<?php

use Illuminate\Database\Eloquent\Model;
use Accendo\PsychometricAssessment\Models\Tool;

class AssessmentStub extends Model
{
    protected $connection = 'testbench';

    protected $table = 'assessments';

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }
}
