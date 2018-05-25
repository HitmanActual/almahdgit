<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doctorName');
            $table->integer('phoneOne')->unsigned();
            $table->integer('phoneTwo')->unsigned()->nullable();
            $table->text('notes')->nullable();
            $table->integer('level_id')->unsigned();
            $table->integer('clinic_id')->unsigned();
           // $table->foreign('level_id')->reference('id')->on('levels')->onDelete('cascade');
           // $table->foreign('clinic_id')->reference('id')->on('clinics')->onDelete('cascade');
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
        Schema::dropIfExists('doctors');
    }
}
