<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanySegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_segments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cs_id')->nullable();
            $table->integer('company_id')->nullable()->unsigned();
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->string('description')->nullable();
            $table->boolean('index')->default(0);
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::table('company_segments', function (Blueprint $table) {
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
        Schema::table('company_segments', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });
        Schema::dropIfExists('company_segments');
    }
}
