<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartOfAccountGroupListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_of_account_group_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coag_id')->nullable()->unsigned();
            $table->integer('account_no')->nullable()->unsigned();
            $table->string('name')->nullable();
            $table->integer('account_type_id')->nullable()->unsigned();
            $table->integer('normal_sign')->nullable()->unsigned();
            $table->integer('nca')->nullable()->unsigned();
            $table->integer('account_map_no_id')->nullable()->unsigned();
            $table->integer('account_group_id')->nullable()->unsigned();
            $table->integer('account_class_id')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('chart_of_account_group_lists', function (Blueprint $table) {
            $table->foreign('coag_id')->references('id')->on('chart_of_account_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chart_of_account_group_lists', function (Blueprint $table) {
            $table->dropForeign(['coag_id']);
        });
        Schema::dropIfExists('chart_of_account_group_lists');
    }
}
