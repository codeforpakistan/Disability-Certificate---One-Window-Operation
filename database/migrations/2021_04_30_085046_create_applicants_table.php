<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('cnic')->unique();
            $table->date('dob')->nullable();
            $table->string('name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('qualification')->nullable();
            $table->string('type_of_disability')->nullable();
            $table->string('nature_of_disability')->nullable();
            $table->string('cause_of_disability')->nullable();
            $table->string('source_of_income')->nullable();
            $table->string('type_of_job')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
