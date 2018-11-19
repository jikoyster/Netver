<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAccountMapsAddAccountGroupId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_maps', function (Blueprint $table) {
            $table->integer('account_group_id')->nullable()->unsigned()->after('sign_id');
        });
        Schema::table('account_maps', function (Blueprint $table) {
            $table->foreign('account_group_id')->references('id')->on('account_groups');
        });

        Schema::table('map_group_lists', function (Blueprint $table) {
            $table->integer('group')->nullable()->unsigned()->after('sign');
        });
        Schema::table('map_group_lists', function (Blueprint $table) {
            $table->foreign('group')->references('id')->on('account_groups');
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
            $table->dropForeign(['account_group_id']);
        });
        Schema::table('account_maps', function (Blueprint $table) {
            $table->dropColumn('account_group_id');
        });

        Schema::table('map_group_lists', function (Blueprint $table) {
            $table->dropForeign(['group']);
        });
        Schema::table('map_group_lists', function (Blueprint $table) {
            $table->dropColumn('group');
        });
    }
}
