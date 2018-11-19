<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyFiscalPeriodsControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_fiscal_periods_controls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_fiscal_period_id')->unsigned()->nullable();
            $table->string('sequence')->nullable();
            $table->timestamp('beginning')->nullable();
            $table->timestamp('end')->nullable();
            $table->boolean('locked')->default(0);
            $table->boolean('adjusting_period')->default(0);
            $table->timestamps();
        });
        Schema::table('company_fiscal_periods_controls', function (Blueprint $table) {
            $table->foreign('company_fiscal_period_id')->references('id')->on('company_fiscal_periods');
        });
        Schema::table('company_fiscal_periods', function (Blueprint $table) {
            $table->integer('period_date_sequence')->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_fiscal_periods_controls', function (Blueprint $table) {
            $table->dropForeign(['company_fiscal_period_id']);
        });
        Schema::table('company_fiscal_periods', function (Blueprint $table) {
            $table->dropColumn('period_date_sequence');
        });
        Schema::dropIfExists('company_fiscal_periods_controls');
    }
}
