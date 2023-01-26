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
            $table->integer('lecture_id');
            $table->string('resource_type');
            $table->string('title');
            $table->string('sub_title');
            $table->string('summary');
            $table->string('url');
            $table->integer('file_id');
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
