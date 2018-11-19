<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobProjectStatusHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_project_status_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jp_id')->nullable()->unsigned();
            $table->boolean('activated')->default(0);
            $table->timestamps();
        });

        Schema::table('job_project_status_histories', function (Blueprint $table) {
            $table->foreign('jp_id')->references('id')->on('job_projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_project_status_histories', function (Blueprint $table) {
            $table->dropForeign(['jp_id']);
        });
        Schema::dropIfExists('job_project_status_histories');
    }
}
