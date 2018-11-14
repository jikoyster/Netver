<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('account_no')->nullable();
            $table->string('legal_name')->nullable();
            $table->string('trade_name')->nullable();
            $table->string('registration_type_id')->nullable();
            $table->string('country')->nullable();
            $table->string('currency')->nullable();
            $table->string('industry')->nullable();
            $table->string('tax_jurisdiction')->nullable();
            $table->string('display_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('multi_currency')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('daylight_saving_time')->nullable();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
