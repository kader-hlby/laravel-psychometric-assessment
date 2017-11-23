<?php

namespace Accendo\PsychometricAssessment;

use Accendo\PsychometricAssessment\Contracts\Integratable;
use Accendo\PsychometricAssessment\Models\Tool;
use Accendo\PsychometricAssessment\IntegrationHelpers\Knolskape;

class PsychometricAssessment
{
    // list of methods for integration with knolskape and cut-e
    // register candidate
    // check assessment status
    // get scores

    public function registerIntegratable(Integratable $integratable)
    {
        // make call to cute and knolskape api and store assessments .
        // ............
        
        // mocking
        $tool = $integratable->getIntegratableTools()->knolskape()->first();
        Knolskape::registerIntegratable($integratable,$tool);

        // foreach($integratable->getIntegratableTools()->knolskape()->get() as $tool){
        //     $integratable->assessments()->create([
        //         'tool_id' => $tool->id,
        //         'status' => 'not started',
        //         'url' => 'url'
        //     ]);
        // }
        // if($integratable->getIntegratableTools()->cute()->get()->isNotEmpty())
        //     $integratable->assessments()->create([
        //         'tool_id' => 0,
        //         'status' => 'not started',
        //         'url' => 'url'
        //     ]);
    }

    public function checkAssessmentStatus($assessments)
    {
        return $integratable->getIntegratableId();
    }

    public function getIntegratableScors(Integratable $integratable)
    {
        return $integratable->getIntegratableId();
    }

}