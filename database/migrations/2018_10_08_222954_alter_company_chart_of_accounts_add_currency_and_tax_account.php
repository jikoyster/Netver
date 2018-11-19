<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanyChartOfAccountsAddCurrencyAndTaxAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_chart_of_accounts', function (Blueprint $table) {
            $table->integer('currency')->nullable()->unsigned();
            $table->integer('tax_account')->nullable()->unsigned();
        });
        Schema::table('company_chart_of_accounts', function (Blueprint $table) {
            $table->foreign('currency')->references('id')->on('global_currency_codes');
            $table->foreign('tax_account')->references('id')->on('company_sales_taxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_chart_of_accounts', function (Blueprint $table) {
            $table->dropForeign(['currency']);
            $table->dropForeign(['tax_account']);
        });
        Schema::table('company_chart_of_accounts', function (Blueprint $table) {
            $table->dropColumn('currency');
            $table->dropColumn('tax_account');
        });
    }
}
