<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseCollaboratorsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_collaborators', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('course_id');
            $table->integer('collaborator_id');
            $table->string('access');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course_collaborators');
    }

}
