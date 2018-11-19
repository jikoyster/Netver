<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_chart_of_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('account_no')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->integer('type')->unsigned()->nullable();
            $table->integer('normal_sign')->unsigned()->nullable();
            $table->integer('map_no')->unsigned()->nullable();
            $table->integer('group')->unsigned()->nullable();
            $table->integer('class')->unsigned()->nullable();
            $table->string('opening_balance')->nullable();
            $table->boolean('locked')->default(0);
            $table->string('adjustments')->nullable();
            $table->string('final_balance')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::table('company_chart_of_accounts', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('type')->references('id')->on('account_types');
            $table->foreign('normal_sign')->references('id')->on('signs');
            $table->foreign('map_no')->references('id')->on('account_maps');
            $table->foreign('group')->references('id')->on('account_groups');
            $table->foreign('class')->references('id')->on('account_classes');
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
            $table->dropForeign(['company_id']);
            $table->dropForeign(['type']);
            $table->dropForeign(['normal_sign']);
            $table->dropForeign(['map_no']);
            $table->dropForeign(['group']);
            $table->dropForeign(['class']);
        });
        Schema::dropIfExists('company_chart_of_accounts');
    }
}
