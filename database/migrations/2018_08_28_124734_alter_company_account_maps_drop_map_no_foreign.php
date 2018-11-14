<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanyAccountMapsDropMapNoForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_account_maps', function (Blueprint $table) {
            $table->dropForeign(['map_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_account_maps', function (Blueprint $table) {
            $table->foreign('map_no')->references('id')->on('account_maps');
        });
    }
}
