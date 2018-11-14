<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanySalesTaxesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_sales_taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->nullable();
            $table->string('tax_code')->nullable();
            $table->string('name')->nullable();
            $table->integer('province_state')->nullable()->unsigned();
            $table->string('city')->nullable();
            $table->string('tax_rate')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });
        Schema::table('company_sales_taxes', function (Blueprint $table) {
            $table->foreign('province_state')->references('id')->on('state_provinces');
            $table->foreign('company_id')->references('id')->on('companies');
        });

        Schema::create('grouped_company_sales_taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('tax_rate_id')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('grouped_company_sales_taxes', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('company_sales_taxes');
            $table->foreign('tax_rate_id')->references('id')->on('company_sales_taxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grouped_company_sales_taxes', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['tax_rate_id']);
        });
        Schema::dropIfExists('grouped_company_sales_taxes');

        Schema::table('company_sales_taxes', function (Blueprint $table) {
            $table->dropForeign(['province_state']);
            $table->dropForeign(['company_id']);
        });
        Schema::dropIfExists('company_sales_taxes');
    }
}
