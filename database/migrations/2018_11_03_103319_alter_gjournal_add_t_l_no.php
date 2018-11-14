<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGjournalAddTLNo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_journals', function (Blueprint $table) {
            $table->string('t_l_no')->nullable();
            $table->string('line_no')->nullable();
            $table->string('split_id_no')->nullable();
            $table->string('original_amount_to_split')->nullable();
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
            $table->dropColumn('t_l_no');
            $table->dropColumn('line_no');
            $table->dropColumn('split_id_no');
            $table->dropColumn('original_amount_to_split');
        });
    }
}
