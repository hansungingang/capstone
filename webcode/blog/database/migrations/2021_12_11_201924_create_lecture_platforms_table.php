<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecture_platforms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lecture_id');
            $table->string('platform_name');
            $table->string('url');
            $table->string('price');
            $table->timestamp('end_time')->nullable()->comment('강의 종료 시간');
            $table->integer('watch_time')->default(0)->comment('강의 시청 가능 기간, 0이면 평생보기 가능');
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
        Schema::table('lecture_platforms', function (Blueprint $table) {
            $table->dropForeign('lecture_platforms_lecture_id_foreign');
        });
        Schema::dropIfExists('lecture_platforms');
    }
}
