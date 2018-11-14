<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanySalesTaxesAddLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_sales_taxes', function (Blueprint $table) {
            $table->integer('location')->nullable()->unsigned();
        });
        Schema::table('company_sales_taxes', function (Blueprint $table) {
            $table->foreign('location')->references('id')->on('company_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_sales_taxes', function (Blueprint $table) {
            $table->dropForeign(['location']);
        });
        Schema::table('company_sales_taxes', function (Blueprint $table) {
            $table->dropColumn('location');
        });
    }
}
