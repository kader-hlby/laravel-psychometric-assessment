<?php

namespace Accendo\PsychometricAssessment;

use Illuminate\Support\ServiceProvider;

class PsychometricAssessmentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/../config/psychometric_assessment.php' => config_path('psychometric_assessment.php'),
        ], 'config');
    }
}
