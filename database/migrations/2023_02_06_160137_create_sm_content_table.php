<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSMContentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_content', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('course_id');
            $table->integer('lecture_id')->nullable();
            $table->string('sm_type');
            $table->string('title');
            $table->string('url')->nullable();
            $table->boolean('is_hashtag');
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
        Schema::drop('sm_content');
    }

}
