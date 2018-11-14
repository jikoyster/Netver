<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_menu', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
            $table->integer('menu_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('group_menu', function (Blueprint $table) {
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('group_id')->references('id')->on('groups');
        });

        Schema::table('group_user', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_menu');
    }
}
