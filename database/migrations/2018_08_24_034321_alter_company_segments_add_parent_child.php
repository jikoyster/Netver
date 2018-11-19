<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanySegmentsAddParentChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_segments', function (Blueprint $table) {
            $table->integer('parent_id')->nullable()->unsigned();
            $table->boolean('has_children')->default(0);
        });

        Schema::table('company_segments', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('company_segments');
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
            $table->dropForeign(['parent_id']);
        });
        Schema::table('company_segments', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('has_children');
        });
    }
}
