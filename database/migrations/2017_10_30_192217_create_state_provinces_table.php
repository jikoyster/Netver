<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_provinces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_currency_id')->unsigned();
            $table->string('state_province_name');
            $table->boolean('inactive');
            //$table->timestamps();
        });

        Schema::table('state_provinces', function (Blueprint $table) {
            $table->foreign('country_currency_id')->references('id')->on('country_currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('state_provinces');
    }
}
