<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->integer('star');
            $table->integer('difficulty');
            $table->unsignedBigInteger('lecture_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parent_review')->nullable();
            $table->timestamps();

            $table->foreign('lecture_id')->references('id')->on('lectures');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_lecture_id_foreign');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_user_id_foreign');
        });
        Schema::dropIfExists('reviews');
    }
}
