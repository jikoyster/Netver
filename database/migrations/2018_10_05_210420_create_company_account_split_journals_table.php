<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAccountSplitJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_account_split_journals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('split_t_no')->nullable();
            $table->string('line_no')->nullable();
            $table->string('company_key')->nullable();
            $table->string('t_no')->nullable();
            $table->string('t_l_no')->nullable();
            $table->string('t_sign')->nullable();
            $table->string('amount_to_split')->nullable();
            $table->string('split_by')->nullable();
            $table->string('sub_account_no')->nullable();
            $table->string('split_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_account_split_journals');
    }
}
