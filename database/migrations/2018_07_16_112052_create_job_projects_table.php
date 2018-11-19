<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jp_id')->nullable();
            $table->integer('company_id')->nullable()->unsigned();
            $table->string('name')->nullable();
            $table->integer('location')->nullable()->unsigned();
            $table->integer('parent')->nullable()->unsigned();
            $table->string('description');
            $table->boolean('index')->default(0);
            $table->boolean('has_a_child')->default(0);
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::table('job_projects', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('location')->references('id')->on('company_locations');
            $table->foreign('parent')->references('id')->on('job_projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_projects', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['location']);
            $table->dropForeign(['parent']);
        });
        Schema::dropIfExists('job_projects');
    }
}
