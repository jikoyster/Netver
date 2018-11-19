<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCountryAndStateAddFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('country_currencies', function (Blueprint $table) {
            $table->string('flag')->nullable();
        });
        Schema::table('state_provinces', function (Blueprint $table) {
            $table->string('flag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('country_currencies', function (Blueprint $table) {
            $table->dropColumn('flag');
        });
        Schema::table('state_provinces', function (Blueprint $table) {
            $table->dropColumn('flag');
        });
    }
}
