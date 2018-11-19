<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_journals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->nullable();
            $table->string('transaction_no')->nullable();
            $table->string('company_key')->nullable();
            $table->timestamp('date')->nullable();
            $table->text('description')->nullable();
            $table->string('account')->nullable();
            $table->string('journal')->nullable();
            $table->string('amount')->nullable();
            $table->string('location')->nullable();
            $table->string('segment')->nullable();
            $table->string('job_project')->nullable();
            $table->string('flag')->nullable();
            $table->string('note')->nullable();
            $table->string('index')->nullable();
            $table->dateTime('modified_date_and_time')->nullable();
            $table->string('user')->nullable();
            $table->timestamp('posted')->nullable();
            $table->timestamps();
        });
        Schema::table('g_journals', function (Blueprint $table) {
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
        Schema::table('g_journals', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });
        Schema::dropIfExists('g_journals');
    }
}
