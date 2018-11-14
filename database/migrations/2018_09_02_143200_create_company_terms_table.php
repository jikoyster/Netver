<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_terms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->nullable();
            $table->string('name');
            $table->boolean('standard')->default(0);
            $table->boolean('data_driven')->default(0);
            $table->string('net_due')->nullable();
            $table->string('discount')->nullable();
            $table->string('discount_if_paid')->nullable();
            $table->boolean('inactive')->default(0);
            $table->timestamps();
        });
        Schema::table('company_terms', function (Blueprint $table) {
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
        Schema::table('company_terms', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });
        Schema::dropIfExists('company_terms');
    }
}
