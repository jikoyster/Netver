<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSectionCategoryablesAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('section_categoryables', function (Blueprint $table) {
            $table->integer('section_category_id')->nullable()->unsigned()->change();
            $table->foreign('section_category_id')->references('id')->on('section_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('section_categoryables', function (Blueprint $table) {
            //
        });
    }
}
