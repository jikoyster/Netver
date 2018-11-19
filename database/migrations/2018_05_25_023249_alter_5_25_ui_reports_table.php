<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alter525UiReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ui_reports', function (Blueprint $table) {
            $table->string('resolved_status');
            $table->integer('resolved_by')->nullable()->unsigned();
            $table->timestamp('resolved_at')->nullable();
        });

        Schema::table('ui_reports', function (Blueprint $table) {
            $table->foreign('resolved_by')->references('id')->on('users');
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
            $table->dropForeign(['resolved_by']);
        });

        Schema::table('ui_reports', function (Blueprint $table) {
            $table->dropColumn('resolved_status');
            $table->dropColumn('resolved_by');
            $table->dropColumn('resolved_at');
        });
    }
}
