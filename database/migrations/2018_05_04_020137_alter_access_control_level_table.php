<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAccessControlLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_control_levels', function (Blueprint $table) {
            $table->dropColumn('control_name');
            
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_control_levels', function (Blueprint $table) {
            $table->string('control_name');

            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
}
