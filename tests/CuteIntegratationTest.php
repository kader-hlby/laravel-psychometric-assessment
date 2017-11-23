<?php

use Accendo\PsychometricAssessment\Models\Tool;
use Accendo\PsychometricAssessment\Models\Assessment;
use Accendo\PsychometricAssessment\Facades\PsychometricAssessment;
use Accendo\PsychometricAssessment\IntegrationHelpers\CutE;

class CuteIntegratationTest extends TestCase
{
    protected $integratable,$tools,$assessments;

    public function setUp(){
        parent::setUp();
        
        $this->integratable = \IntegratableStub::create([
            'email' => 'candidate@g.c'
        ]);
    
    }
    
    /** @test */
    public function it_should_call_registration_api(){
        
        $cute = new CutE;

        $response = $cute->callRegistrationApi($this->integratable);
        
        $this->assertArrayHasKey('assessment_url',$response);
    
    }
    
    /** @test */
    public function it_should_call_check_assessment_api()
    {
        $cute = new CutE;
        
        $response = $cute->callCheckStatusApi($this->integratable);

        $this->assertArrayHasKey('status',$response);
        $this->assertNotEquals($response['status'],"undefine");
    }

}