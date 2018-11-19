<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanySalesTaxesAddTaxAgency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_sales_taxes', function (Blueprint $table) {
            $table->integer('tax_agency')->nullable()->unsigned();
        });
        Schema::table('company_sales_taxes', function (Blueprint $table) {
            $table->foreign('tax_agency')->references('id')->on('company_vendors');
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
            $table->dropForeign(['tax_agency']);
        });
        Schema::table('company_sales_taxes', function (Blueprint $table) {
            $table->dropColumn('tax_agency');
        });
    }
}
