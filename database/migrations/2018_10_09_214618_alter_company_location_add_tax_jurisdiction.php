<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanyLocationAddTaxJurisdiction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_locations', function (Blueprint $table) {
            $table->integer('tax_jurisdiction')->nullable()->unsigned();
        });
        Schema::table('company_locations', function (Blueprint $table) {
            $table->foreign('tax_jurisdiction')->references('id')->on('state_provinces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_locations', function (Blueprint $table) {
            $table->dropForeign(['tax_jurisdiction']);
        });
        Schema::table('company_locations', function (Blueprint $table) {
            $table->dropColumn('tax_jurisdiction');
        });
    }
}
