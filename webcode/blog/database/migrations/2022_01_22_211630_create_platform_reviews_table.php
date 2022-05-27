<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('platform_name');
            $table->string('title')->nullable();
            $table->string('content');
            $table->string('user_name');
            $table->unsignedBigInteger('lecture_id');
            $table->timestamps();

            $table->foreign('lecture_id')->references('id')->on('lectures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('platform_reviews', function (Blueprint $table) {
            $table->dropForeign('platform_reviews_lecture_id_foreign');
        });
        Schema::dropIfExists('platform_reviews');
    }
}
