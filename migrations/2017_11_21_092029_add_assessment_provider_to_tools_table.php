<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssessmentProviderToToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('psychometric_assessment_tools', function (Blueprint $table) {
            $table->enum('assessment_provider', config('psychometric_assessment.assessments_providers'))->default('cute');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('psychometric_assessment_tools', function (Blueprint $table) {
            $table->dropColumn('assessment_provider');
        });
    }
}
