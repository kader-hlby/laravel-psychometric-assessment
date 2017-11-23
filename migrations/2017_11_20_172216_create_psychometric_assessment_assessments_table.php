<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePsychometricAssessmentAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psychometric_assessment_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer(config('psychometric_assessment.intgratable_id')); 
            $table->integer('tool_id');
            $table->string('status');
            $table->string('url');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psychometric_assessment_assessments');
    }
}
