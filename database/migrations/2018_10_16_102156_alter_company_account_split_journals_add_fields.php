<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanyAccountSplitJournalsAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_account_split_journals', function (Blueprint $table) {
            $table->string('split_amount_by')->nullable()->after('split_by');
            $table->string('note')->nullable()->after('split_amount');
        });
        Schema::table('g_journals', function (Blueprint $table) {
            $table->string('split_selected')->boolean()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_account_split_journals', function (Blueprint $table) {
            $table->dropColumn('split_amount_by');
            $table->dropColumn('note');
        });
        Schema::table('g_journals', function (Blueprint $table) {
            $table->dropColumn('split_selected');
        });
    }
}
