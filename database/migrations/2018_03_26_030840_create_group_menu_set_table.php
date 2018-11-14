<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMenuSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_menu_set', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
            $table->integer('menu_set_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('group_menu_set', function (Blueprint $table) {
            $table->foreign('menu_set_id')->references('id')->on('menu_sets');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_menu_set');
    }
}
