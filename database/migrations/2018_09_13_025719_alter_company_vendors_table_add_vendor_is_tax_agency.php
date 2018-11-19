<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanyVendorsTableAddVendorIsTaxAgency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_vendors', function (Blueprint $table) {
            $table->boolean('vendor_is_tax_agency')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_vendors', function (Blueprint $table) {
            $table->dropColumn('vendor_is_tax_agency');
        });
    }
}
