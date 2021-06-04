<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //one to many
      Schema::table('cars', function (Blueprint $table) {
        $table -> foreign('brand_id', 'brandcar')
        -> references('id')
        -> on('brands');
      });

      //many to many
      Schema::table('car_pilot', function (Blueprint $table) {
        $table -> foreign('car_id', 'pilotcar')
        -> references('id')
        -> on('cars');
        $table -> foreign('pilot_id', 'carpilot')
        -> references('id')
        -> on('pilots');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      ////Pilot <-N----M-> Car <-N----1-> Brand
      ////one to many
      Schema::table('cars', function (Blueprint $table) {
        $table -> dropForeign('brandcar');
      });


      ////many to many
      Schema::table('car_pilot', function (Blueprint $table) {
        $table -> dropForeign('pilotcar');
        $table -> dropForeign('carpilot');
      });
    }
}
