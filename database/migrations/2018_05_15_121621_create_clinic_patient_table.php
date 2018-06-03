<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_patient', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinic_id')->unsigned();
            $table->integer('patient_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('clinic_patient', function($table) {
            $table->foreign('clinic_id')->references('id')->on('clinics');
            $table->foreign('patient_id')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_patient');
    }
}
