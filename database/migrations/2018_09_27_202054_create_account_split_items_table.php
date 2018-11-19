<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountSplitItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_split_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('account_no')->unsigned()->nullable();
            $table->integer('sub_account_no')->unsigned()->nullable();
            $table->string('sub_account_name')->nullable();
            $table->timestamps();
        });
        Schema::table('account_split_items', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('account_no')->references('id')->on('company_chart_of_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_split_items', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['account_no']);
        });
        Schema::dropIfExists('account_split_items');
    }
}
