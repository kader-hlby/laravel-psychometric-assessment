<?php
return [
        /*
                * When migrating the "assessment" table from this package, we need to know 
                * the column name should be used to link your integratable table.We have chosen 
                * a basic default value but you may easily change it to any column you like.
                */

        'intgratable_id' => 'candidate_id',
        'assessments_providers' => [
                'cute',
                'knolskape'
        ],
        'cute' => [
                'protocol' => env('CUTE_PROTOCOL', 'https'),
                'domain' => env('CUTE_DOMAIN', 'www.cut-e.net'),
                'path' => env('CUTE_PATH', 'maptq/ws')
        ],
        'assessments_providers_urls' => [
                'knolskape' => [
                        'registration' => 'https://api-test.knolskape.com/ct/simulations/register?platformId=2',
                        'check_status' => ''
                ]    
        ]
];