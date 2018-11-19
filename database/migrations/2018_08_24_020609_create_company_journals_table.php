<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_journals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->nullable();
            $table->string('journalid')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->boolean('journal_index')->default(0);
            $table->boolean('show_debit_credit')->default(0);
            $table->boolean('journal_active')->default(0);
            $table->timestamps();
        });
        Schema::table('company_journals', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_journals', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });
        Schema::dropIfExists('company_journals');
    }
}
