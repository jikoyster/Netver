<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessLevelControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_control_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('control_name');
            //$table->integer('permission_id')->unsigned();
            //$table->integer('feature_id')->unsigned();
            $table->boolean('enabled');
            $table->string('url');
            $table->string('parameter');
            $table->integer('creator_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('access_control_levels', function (Blueprint $table) {
            //$table->foreign('permission_id')->references('id')->on('permissions');
            //$table->foreign('feature_id')->references('id')->on('features');
            $table->foreign('creator_id')->references('id')->on('users');
        });

        Schema::create('access_control_level_feature', function (Blueprint $table) {
            $table->integer('access_control_level_id')->unsigned();
            $table->integer('feature_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('access_control_level_feature', function (Blueprint $table) {
            $table->foreign('access_control_level_id')->references('id')->on('access_control_levels');
            $table->foreign('feature_id')->references('id')->on('features');
        });

        Schema::table('model_has_permissions', function (Blueprint $table) {
            $table->dropForeign(['model_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_control_level_feature', function (Blueprint $table) {
            $table->dropForeign(['access_control_level_id']);
            $table->dropForeign(['feature_id']);
        });
        Schema::dropIfExists('access_control_level_feature');
        Schema::dropIfExists('access_control_levels');
    }
}
