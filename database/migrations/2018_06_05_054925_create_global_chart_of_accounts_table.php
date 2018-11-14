<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_chart_of_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_no');
            $table->string('name');
            $table->integer('account_map_no')->nullable()->unsigned();
            $table->integer('account_type_id')->nullable()->unsigned();
            $table->integer('sign_id')->nullable()->unsigned();
            $table->integer('account_group_id')->nullable()->unsigned();
            $table->integer('account_class_id')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('global_chart_of_accounts', function (Blueprint $table) {
            $table->foreign('account_map_no')->references('id')->on('account_maps');
            $table->foreign('account_type_id')->references('id')->on('account_types');
            $table->foreign('sign_id')->references('id')->on('signs');
            $table->foreign('account_class_id')->references('id')->on('account_classes');
            $table->foreign('account_group_id')->references('id')->on('account_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('global_chart_of_accounts', function (Blueprint $table) {
            $table->dropForeign(['account_map_no']);
            $table->dropForeign(['account_type_id']);
            $table->dropForeign(['sign_id']);
            $table->dropForeign(['account_class_id']);
            $table->dropForeign(['account_group_id']);
        });
        Schema::dropIfExists('global_chart_of_accounts');
    }
}
