<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanyDocumentsReplaceCompanyIdWithKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_documents', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });

        Schema::table('company_documents', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->string('company_key')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {Schema::table('company_documents', function (Blueprint $table) {
            $table->dropColumn('company_key');
            $table->integer('company_id')->nullable()->unsigned()->after('id');
        });

        Schema::table('company_documents', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }
}
