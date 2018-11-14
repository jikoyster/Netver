<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDefaultAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_default_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_key')->nullable();
            $table->integer('retained_earnings')->unsigned()->nullable();
            $table->integer('accounts_payable')->unsigned()->nullable();
            $table->integer('accounts_receivable')->unsigned()->nullable();
            $table->integer('purchase_discounts')->unsigned()->nullable();
            $table->integer('sales_discounts')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('company_default_accounts', function (Blueprint $table) {
            $table->foreign('retained_earnings')->references('id')->on('company_chart_of_accounts');
            $table->foreign('accounts_payable')->references('id')->on('company_chart_of_accounts');
            $table->foreign('accounts_receivable')->references('id')->on('company_chart_of_accounts');
            $table->foreign('purchase_discounts')->references('id')->on('company_chart_of_accounts');
            $table->foreign('sales_discounts')->references('id')->on('company_chart_of_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_default_accounts', function (Blueprint $table) {
            $table->dropForeign(['retained_earnings']);
            $table->dropForeign(['accounts_payable']);
            $table->dropForeign(['accounts_receivable']);
            $table->dropForeign(['purchase_discounts']);
            $table->dropForeign(['sales_discounts']);
        });
        Schema::dropIfExists('company_default_accounts');
    }
}
