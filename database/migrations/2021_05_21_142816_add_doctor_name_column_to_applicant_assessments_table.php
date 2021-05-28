<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoctorNameColumnToApplicantAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicant_assesments', function (Blueprint $table) {
            $table->string('doctor_name')->nullable()->after('applicant_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicant_assesments', function (Blueprint $table) {
            $table->dropColumn(['doctor_name']);
        });
    }
}
