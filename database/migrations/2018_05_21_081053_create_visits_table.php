<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinic_id')->unsigned();
            $table->integer('patients_id')->unsigned();
            $table->integer('visitType_id')->unsigned();
            $table->decimal('price', 15, 2)->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::table('visits', function($table) {
            $table->foreign('visitType_id')->references('id')->on('visit_types');
            $table->foreign('patients_id')->references('id')->on('patients');
            $table->foreign('clinic_id')->references('id')->on('clinics');
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
