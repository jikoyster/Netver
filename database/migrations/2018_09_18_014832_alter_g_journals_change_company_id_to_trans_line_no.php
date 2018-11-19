<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGJournalsChangeCompanyIdToTransLineNo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_journals', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });
        Schema::table('g_journals', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->string('trans_line_no')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('g_journals', function (Blueprint $table) {
            $table->integer('company_id')->nullable()->unsigned()->after('id');
            $table->dropColumn('trans_line_no');
        });
        Schema::table('g_journals', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }
}
