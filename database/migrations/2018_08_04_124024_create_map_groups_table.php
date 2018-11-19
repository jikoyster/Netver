<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->integer('nca_id')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('map_groups', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('country_currencies');
            $table->foreign('nca_id')->references('id')->on('national_chart_of_accounts');
        });

        Schema::create('map_group_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('map_group_id')->nullable()->unsigned();
            $table->integer('map_no')->nullable()->unsigned();
            $table->string('name')->nullable();
            $table->integer('parent_id')->nullable()->unsigned();
            $table->integer('nca')->nullable()->unsigned();
            $table->boolean('title');
            $table->boolean('unassignable');
            $table->string('flip_type')->nullable();
            $table->integer('flip_to')->nullable()->unsigned();
            $table->integer('type')->nullable()->unsigned();
            $table->integer('sign')->nullable()->unsigned();
            $table->integer('class')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('map_group_lists', function (Blueprint $table) {
            $table->foreign('map_group_id')->references('id')->on('map_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('map_group_lists', function (Blueprint $table) {
            $table->dropForeign(['map_group_id']);
        });
        Schema::dropIfExists('map_group_lists');

        Schema::table('map_groups', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });
        Schema::dropIfExists('map_groups');
    }
}
