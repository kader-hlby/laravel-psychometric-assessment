<?php

use Accendo\PsychometricAssessment\Models\Tool;
use Accendo\PsychometricAssessment\Models\Assessment;
use Accendo\PsychometricAssessment\Facades\PsychometricAssessment;

use GuzzleHttp\Client;

class RegisterIntegratableTest extends TestCase
{
    protected $integratable,$tools,$assessments;

    public function setUp(){
        parent::setUp();
        
        $this->integratable = \IntegratableStub::create([
            'email' => 'candidate1@gmail.com'
        ]);

        $tools = [
            ['name'=>'byb' , 'assessment_provider'=> 'knolskape'],
            ['name'=>'ilead', 'assessment_provider'=> 'knolskape'],
            ['name'=>'shapes', 'assessment_provider'=> 'cute'],
            ['name'=>'views' , 'assessment_provider'=> 'cute'],
        ];

        foreach($tools as $tool){
            Tool::create([
                'name' => $tool['name'],
                'assessment_provider' => $tool['assessment_provider']
            ]);
        }

        // $this->tools = Tool::all();

        // $tool_ids = Tool::whereIn('name',$tool_names)->get()->pluck('id');
        
        // foreach($tool_ids as $tool_id){
        //     Assessment::create([
        //         'candidate_id'=> $this->candidate->id,
        //         'tool_id'=> $tool_id,
        //         'status'=>'not started',
        //         'url'=>''
        //     ]);
        // }

        // $this->assessments = Assessment::all();
        
    }

    /** @test */
    public function it_should_register_integratable(){
        
        PsychometricAssessment::registerIntegratable($this->integratable);
        
        $cute_assessments_count = $this->integratable->getIntegratableTools()->cute()->get()->count();
        
        $this->assertEquals(
            ($this->integratable->getIntegratableTools()->get()->count() - $cute_assessments_count + 1),
            $this->integratable->assessments->count()
        );
    }
    
}