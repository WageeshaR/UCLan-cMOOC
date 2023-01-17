<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('author_id');
            $table->integer('lecture_id');
            $table->string('location')->nullable();
            $table->string('content')->nullable();
            $table->string('image_src')->nullable();
            $table->string('tweet_url')->nullable();
            $table->string('video_url')->nullable();
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
        Schema::drop('posts');
    }

}
