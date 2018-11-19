<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_province_name')->unsigned();
            $table->string('line1');
            $table->string('line2');
            $table->string('city');
            $table->string('zip_code');
            $table->integer('time_zone')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::create('model_address', function (Blueprint $table) {
            $table->integer('address_id')->unsigned();
            $table->integer('model_id')->unsigned();
            $table->string('model_type');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('state_province_name')->references('id')->on('state_provinces');
            $table->foreign('time_zone')->references('id')->on('timezone_datas');
        });

        Schema::table('model_address', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['state_province_name']);
        });
        Schema::table('model_address', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
        });
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('model_address');
    }
}
