<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserAddressesAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->integer('time_zone')->nullable()->unsigned()->change();
            $table->foreign('time_zone')->references('id')->on('timezone_datas');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->integer('time_zone')->nullable()->unsigned()->change();
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
        Schema::table('user_addresses', function (Blueprint $table) {
            //
        });
    }
}
