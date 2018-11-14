<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAgainUiReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ui_reports', function (Blueprint $table) {
            $table->string('page');
            $table->renameColumn('fixed', 'status');
        });

        Schema::table('ui_reports', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
            $table->text('issue')->nullable()->change();
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
            $table->dropColumn('page');
            $table->renameColumn('status', 'fixed');
        });

        Schema::table('ui_reports', function (Blueprint $table) {
            $table->boolean('fixed')->default(0)->change();
            $table->string('issue')->nullable()->change();
        });
    }
}
