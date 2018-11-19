<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterChartOfAccountGroupsAddMapGroupId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chart_of_account_groups', function (Blueprint $table) {
            $table->integer('map_group_id')->nullable()->unsigned();
        });

        Schema::table('chart_of_account_groups', function (Blueprint $table) {
            $table->foreign('map_group_id')->references('id')->on('map_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chart_of_account_groups', function (Blueprint $table) {
            $table->dropForeign(['map_group_id']);
        });
        Schema::table('chart_of_account_groups', function (Blueprint $table) {
            $table->dropColumn('map_group_id');
        });
    }
}
