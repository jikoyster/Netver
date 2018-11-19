<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('address_id')->unsigned();
            $table->integer('state_province_name')->unsigned();
            $table->string('line1');
            $table->string('line2');
            $table->string('city');
            $table->string('zip_code');
            $table->integer('time_zone')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('address_histories', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('state_province_name')->references('id')->on('state_provinces');
            $table->foreign('time_zone')->references('id')->on('timezone_datas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('address_histories', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
            $table->dropForeign(['state_province_name']);
            $table->dropForeign(['time_zone']);
        });
        Schema::dropIfExists('address_histories');
    }
}
