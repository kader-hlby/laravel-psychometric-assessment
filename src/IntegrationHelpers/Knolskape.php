<?php

namespace Accendo\PsychometricAssessment\IntegrationHelpers;

use GuzzleHttp\Client;

use Accendo\PsychometricAssessment\Contracts\Integratable;

class Knolskape
{
    public static function registerIntegratable(Integratable $integratable,$tool){
        
        $data = [
            "projectId"=> $integratable->getknolskapeProjectId(),
            "users"=>["email"=>$integratable->getIntegratableEmail()],
            "services"=>[$tool->name]
        ];

        $url = config('psychometric_assessment.assessments_providers_urls.knolskape.registration');
        
        $client = new Client;

        $response = $client->request('POST', $url, $data);

        dd($response);
    }

}
