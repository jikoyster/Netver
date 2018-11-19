<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompaniesAndCompanyOwnersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_owners', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->string('company_key')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_owners', function (Blueprint $table) {
            $table->string('uuid');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('company_key');
        });
    }
}
