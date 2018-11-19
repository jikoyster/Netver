<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableForGlobalAccountingSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->string('code');
            $table->string('name');
            $table->boolean('has_children');
            $table->timestamps();
        });

        Schema::table('account_groups', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('account_groups');
        });

        Schema::create('account_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->string('code');
            $table->string('name');
            $table->boolean('has_children');
            $table->timestamps();
        });

        Schema::table('account_classes', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('account_classes');
        });

        Schema::create('national_chart_of_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('national_chart_of_accounts', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('country_currencies');
        });

        Schema::create('national_chart_of_account_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nca_id')->unsigned();
            $table->string('code');
            $table->integer('account_type')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::table('national_chart_of_account_lists', function (Blueprint $table) {
            $table->foreign('nca_id')->references('id')->on('national_chart_of_accounts');
            $table->foreign('account_type')->references('id')->on('account_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_groups', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
        Schema::table('account_classes', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
        Schema::table('national_chart_of_accounts', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });
        Schema::table('national_chart_of_account_lists', function (Blueprint $table) {
            $table->dropForeign(['nca_id']);
            $table->dropForeign(['account_type']);
        });
        Schema::dropIfExists('account_groups');
        Schema::dropIfExists('account_classes');
        Schema::dropIfExists('national_chart_of_accounts');
        Schema::dropIfExists('national_chart_of_account_lists');
    }
}
