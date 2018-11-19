<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupedTaxRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grouped_tax_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('tax_rate_id')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('grouped_tax_rates', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('tax_rates');
            $table->foreign('tax_rate_id')->references('id')->on('tax_rates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grouped_tax_rates', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['tax_rate_id']);
        });
        Schema::dropIfExists('grouped_tax_rates');
    }
}
