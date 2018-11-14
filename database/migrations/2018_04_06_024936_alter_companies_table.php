<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::create('company_owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('ownership_percentage');
            $table->date('date_ownership');
            $table->date('leave_ownership');
            $table->timestamps();
        });

        Schema::table('company_owners', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_owners');
        Schema::table('companies', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->unsigned()->after('id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
