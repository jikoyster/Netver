<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalCurrencyCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_currency_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entity')->nullable();
            $table->string('currency')->nullable();
            $table->string('alphabetic_code')->nullable();
            $table->string('numeric_code')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_currency_codes');
    }
}
