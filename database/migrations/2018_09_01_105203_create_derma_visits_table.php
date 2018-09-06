<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDermaVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('derma_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('clinic_id');
            $table->integer('doctor_id');
            $table->string('allergy');
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
        Schema::dropIfExists('derma_visits');
    }
}
