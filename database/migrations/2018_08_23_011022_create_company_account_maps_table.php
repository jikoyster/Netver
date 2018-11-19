<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAccountMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_account_maps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->nullable()->unsigned();
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
            $table->integer('group')->nullable()->unsigned();
            $table->integer('class')->nullable()->unsigned();
            $table->timestamps();
        });
        Schema::table('company_account_maps', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('map_group_id')->references('id')->on('map_groups');
            $table->foreign('map_no')->references('id')->on('account_maps');
            $table->foreign('parent_id')->references('id')->on('account_maps');
            $table->foreign('nca')->references('id')->on('national_chart_of_account_lists');
            $table->foreign('flip_to')->references('id')->on('account_maps');
            $table->foreign('type')->references('id')->on('account_types');
            $table->foreign('sign')->references('id')->on('signs');
            $table->foreign('group')->references('id')->on('account_groups');
            $table->foreign('class')->references('id')->on('account_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_account_maps', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['map_group_id']);
            $table->dropForeign(['map_no']);
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['nca']);
            $table->dropForeign(['flip_to']);
            $table->dropForeign(['type']);
            $table->dropForeign(['sign']);
            $table->dropForeign(['group']);
            $table->dropForeign(['class']);
        });
        Schema::dropIfExists('company_account_maps');
    }
}
