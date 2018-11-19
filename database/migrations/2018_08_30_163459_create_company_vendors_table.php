<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('display_name')->nullable();
            $table->string('print_cheque_as')->nullable();
            $table->boolean('use_display_name')->default(0);
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->string('subcontractor')->nullable();
            $table->boolean('track_payment_t4a')->default(0);
            $table->boolean('track_payment_5018')->default(0);
            $table->boolean('track_payment_1099')->default(0);
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('account_no')->nullable();
            $table->integer('currency')->nullable()->unsigned();
            $table->string('billing_rate')->nullable();
            $table->string('tax_id')->nullable();
            $table->integer('registration_type')->nullable()->unsigned();
            $table->integer('term')->nullable()->unsigned();
            $table->integer('trade')->nullable()->unsigned();
            $table->string('credit_limit')->nullable();
            $table->timestamps();
        });
        Schema::table('company_vendors', function (Blueprint $table) {
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
        Schema::table('company_vendors', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });
        Schema::dropIfExists('company_vendors');
    }
}
