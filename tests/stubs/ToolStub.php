
<?php

use Illuminate\Database\Eloquent\Model;
use Accendo\PsychometricAssessment\Models\Assessment;

class ToolStub extends Model
{
    protected $connection = 'testbench';

    protected $table = 'tools';

    public function Assessments(){
        return $this->hasMany(Assessment::class,'tool_id');
    }
}
