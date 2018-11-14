<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFiscalAndAccountSplitJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_fiscal_periods', function (Blueprint $table) {
            $table->dropColumn('retained_earning_account');
            $table->dropColumn('amount');
        });
        Schema::table('company_account_split_journals', function (Blueprint $table) {
            $table->dropColumn('split_amount_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_fiscal_periods', function (Blueprint $table) {
            $table->integer('retained_earning_account')->nullable()->unsingned()->after('end_date');
            $table->string('amount')->nullable()->after('retained_earning_account');
        });
        Schema::table('company_account_split_journals', function (Blueprint $table) {
            $table->string('split_amount_by')->nullable()->after('split_by');
        });
    }
}
