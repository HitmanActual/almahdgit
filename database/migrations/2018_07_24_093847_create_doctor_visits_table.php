<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('clinic_id');
            $table->integer('doctor_id');
            $table->string('head_circumference');
            $table->string('weight');
            $table->string('height');
            $table->string('dentition');
            $table->string('development');
            $table->text('present_history_examination');
            $table->string('t');
            $table->string('r');
            $table->string('rr');
            $table->string('hr');
            $table->text('diagnosis');
            $table->string('ttt');
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
        Schema::dropIfExists('doctor_visits');
    }
}
