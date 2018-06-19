<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNutrutionalToPediatricBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pediatric_basic_infos', function (Blueprint $table) {
            //
            $table->text('typeOfFeeding');
            $table->text('ironSup');
            $table->text('nutrittionalDisorder');
            $table->text('onsetOfweaning');
            $table->text('vitDCaSupp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pediatric_basic_infos', function (Blueprint $table) {
            //
        });
    }
}
