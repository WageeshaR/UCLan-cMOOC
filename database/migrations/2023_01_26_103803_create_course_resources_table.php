<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseResourcesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_resources', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('course_id');
            $table->integer('lecture_id')->nullable();
            $table->string('resource_type');
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('summary')->nullable();
            $table->string('url')->nullable();
            $table->integer('file_id')->nullable();
            $table->integer('created_by');
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
        Schema::drop('course_resources');
    }

}
