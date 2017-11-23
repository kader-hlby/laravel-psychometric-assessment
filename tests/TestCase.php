<?php

use Accendo\PsychometricAssessment\PsychometricAssessmentServiceProvider;

abstract class TestCase extends Orchestra\Testbench\TestCase
{
    
    protected function getPackageProviders($app)
    {
        return [PsychometricAssessmentServiceProvider::class];
    }

    public function setUp()
    {
        parent::setUp();
        Eloquent::unguard();
        $this->artisan('migrate', [
            '--database' => 'testbench',
        ]);
    }

    public function tearDown()
    {
        \Schema::drop('candidates');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('psychometric_assessment.intgratable_id', 'candidate_id');
        $app['config']->set('psychometric_assessment.assessments_providers', ['cute','knolskape']);
        $app['config']->set('psychometric_assessment.assessments_providers_urls.knolskape.registration',
                        'https://api-test.knolskape.com/ct/simulations/register?platformId=2');
        
        $app['config']->set('psychometric_assessment.cute',[
            'protocol' => env('CUTE_PROTOCOL', 'https'),
            'domain' => env('CUTE_DOMAIN', 'www.cut-e.net'),
            'path' => env('CUTE_PATH', 'maptq/ws'),
            'secure_code'=> env('CUTE_SECURE_CODE')
        ]);
        
        \Schema::create('candidates', function ($table) {
            $table->increments('id');
            $table->string('email');
            $table->timestamps();
        });
    }
}