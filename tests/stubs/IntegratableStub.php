
<?php

use Illuminate\Database\Eloquent\Model;
use Accendo\PsychometricAssessment\Models\Assessment;
use Accendo\PsychometricAssessment\Models\Tool;
use Accendo\PsychometricAssessment\Contracts\Integratable;

//mocking Integratable model
class IntegratableStub extends Model implements Integratable
{
    //mocking config file
    protected $config = [
        'intgratable_id' => 'candidate_id'
    ];

    protected $table = 'candidates';

    public function assessments()
    {
        return $this->hasMany(Assessment::class,$this->config['intgratable_id']);
    }

    protected $connection = 'testbench';

    public function getIntegratableId()
    {
        return 1;
    }

    public function getIntegratableTools()
    {
        // getIntegratableTools 
        return Tool::where('id','>',0);
    }

    public function getknolskapeProjectId()
    {
        return 125;
    }

    public function getIntegratableEmail()
    {
        return "kader@gmail.com";
    }

}