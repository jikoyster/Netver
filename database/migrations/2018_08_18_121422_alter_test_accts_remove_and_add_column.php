<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTestAcctsRemoveAndAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_accts', function (Blueprint $table) {
            $table->dropColumn('debit');
            $table->dropColumn('credit');
            $table->dropColumn('balance');
            $table->string('amount')->nullable()->after('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_accts', function (Blueprint $table) {
            $table->string('debit')->nullable()->after('date');
            $table->string('credit')->nullable()->after('debit');
            $table->string('balance')->nullable()->after('credit');
            $table->dropColumn('amount');
        });
    }
}
