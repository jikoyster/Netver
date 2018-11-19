<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_maps', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('map_no');
            $table->boolean('title');
            $table->boolean('unassignable');
            $table->string('name');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->integer('account_type_id')->nullable()->unsigned();
            $table->integer('sign_id')->nullable()->unsigned();
            $table->integer('account_class_id')->nullable()->unsigned();
            $table->string('flip_type');
            $table->integer('flip_to')->nullable()->unsigned();
            $table->boolean('has_a_child');
            $table->timestamps();
        });

        Schema::table('account_maps', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('account_maps');
            $table->foreign('account_type_id')->references('id')->on('account_types');
            $table->foreign('sign_id')->references('id')->on('signs');
            $table->foreign('account_class_id')->references('id')->on('account_classes');
            $table->foreign('flip_to')->references('id')->on('account_maps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_maps', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['account_type_id']);
            $table->dropForeign(['sign_id']);
            $table->dropForeign(['account_class_id']);
            $table->dropForeign(['flip_to']);
        });
        Schema::dropIfExists('account_maps');
    }
}
