<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tax_code')->nullable();
            $table->string('name')->nullable();
            $table->integer('province_state')->nullable()->unsigned();
            $table->string('city')->nullable();
            $table->string('tax_rate')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });

        Schema::table('tax_rates', function (Blueprint $table) {
            $table->foreign('province_state')->references('id')->on('state_provinces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tax_rates', function (Blueprint $table) {
            $table->dropForeign(['province_state']);
        });
        Schema::dropIfExists('tax_rates');
    }
}
