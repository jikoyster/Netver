<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUiReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ui_reports', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });
        Schema::table('ui_reports', function (Blueprint $table) {
            $table->integer('company_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ui_reports', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }
}
