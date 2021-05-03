<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantAssesmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_assesments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('applicant_id');
            $table->text('clinical_findings');
            $table->boolean('fit_for_job');
            $table->boolean('fit_for_driving');
            $table->timestamps();
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('applicant_id')->references('id')->on('applicants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicant_assesments');
    }
}
