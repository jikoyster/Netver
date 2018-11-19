<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterChartOfAccountGroupsAddNcaId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chart_of_account_groups', function (Blueprint $table) {
            $table->integer('nca_id')->nullable()->unsigned()->after('name');
        });

        Schema::table('chart_of_account_groups', function (Blueprint $table) {
            $table->foreign('nca_id')->references('id')->on('national_chart_of_accounts');
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
            $table->dropForeign(['nca_id']);
        });
        Schema::table('chart_of_account_groups', function (Blueprint $table) {
            $table->dropColumn('nca_id');
        });
    }
}
