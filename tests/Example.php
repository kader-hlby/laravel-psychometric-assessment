<?php

use Accendo\PsychometricAssessment\Models\Tool;
use Accendo\PsychometricAssessment\Models\Assessment;
use Accendo\PsychometricAssessment\Facades\PsychometricAssessment;

use GuzzleHttp\Client;

class ExampleTest extends TestCase
{
    protected $candidate,$tools,$assessments;

    public function setUp(){
        parent::setUp();
        
        // $this->candidate = \CandidateStub::create([
        //     'email' => 'candidate1@gmail.com'
        // ]);
        
        // $tool_names = ['byb','shapes','views'];

        // foreach($tool_names as $tool_name){
        //     Tool::create([
        //         'name' => $tool_name
        //     ]);
        // }

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

    public function it_should_create_assessmets_taged_to_candidate_and_tool(){
        $this->assertEquals(1,PsychometricAssessment::registerIntegratable(new \IntegratableStub));
        // $this->assertEquals(3,$this->candidate->assessments->count());
    }
    
    public function can_register_candidate_and_store_assessment_details(){
        
        $url = "https://api-test.knolskape.com/ct/simulations/register?platformId=2";
        
        $body = [
            "projectId" => 125,
            "users"     => [
                "email"=>"kader@gmail.com"
            ],
            "services"  => [
                "bysbhtml",
                "ileadhtml",
                "cq-v2"
            ]
        ];
        $client = new Client();
        try{
            $r = $client->request('POST', $url, $body);
        }
        catch(Exception $e){
            dd($e->getResponseBodySummary());
        }
        
        dd($r->error->message);
    }

    public function can_create_tool_and_assessment(){
     $candidate = \CandidateStub::create([
         'email' => 'candidate1@gmail.com'
     ]);

    $this->assertEquals('candidate1@gmail.com',$candidate->email);

    $tool = Tool::create([
        'name' => 'byb'
     ]);
     $this->assertEquals('byb',$tool->name);

     Assessment::create([
        'candidate_id'=> $candidate->id,
        'tool_id'=> $tool->id,
        'status'=>'',
        'url'=>''
     ]);
     Assessment::create([
        'candidate_id'=> 2,
        'tool_id'=> $tool->id,
        'status'=>'',
        'url'=>''
     ]);
     $this->assertEquals(2,$tool->assessments->count());
    }
}