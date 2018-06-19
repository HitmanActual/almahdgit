<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePediatricBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pediatric_basic_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('consanguinity');
            $table->text('occupation');
            $table->text('numberOfSiblings');
            $table->text('age');
            $table->text('sex');
            $table->text('similarCondition');
            $table->text('congenitalAnomalies');
            $table->text('allergy');
            $table->text('dm');
            $table->text('dmOne');
            $table->text('typeOfLabor');
            $table->text('medications');
            $table->text('durationOfPregnancy');
            $table->text('jaundice');
            $table->text('rd');
            $table->text('birthWeight');
            $table->text('allergyOne');
            $table->text('operation');
            $table->text('chronicalIllness');
            $table->text('trumaAndAccident');
            $table->text('infection');
            $table->integer('patient_id')->unsigned();
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
        Schema::dropIfExists('pediatric_basic_infos');
    }
}
