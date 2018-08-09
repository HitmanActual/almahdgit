<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrthopedicVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orthopedic_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('clinic_id');
            $table->integer('doctor_id');
            $table->text('co');
            $table->text('clinical_finding');
            $table->text('investigations');
            $table->text('treatment');
            $table->text('diagnosis');
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
        Schema::dropIfExists('orthopedic_visits');
    }
}
