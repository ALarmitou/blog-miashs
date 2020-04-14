<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_posts', function (Blueprint $table) {
            $table->unsignedInteger('post_file_id');
            $table->unsignedInteger('post_post_id');

            $table->foreign('post_file_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('post_post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->primary(['post_file_id','post_post_id']);
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_posts');
    }
}
