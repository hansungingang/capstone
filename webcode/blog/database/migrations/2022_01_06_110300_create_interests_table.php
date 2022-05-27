<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lecture_id');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('interests', function (Blueprint $table) {
            $table->dropForeign('interests_user_id_foreign');
        });
        Schema::table('interests', function (Blueprint $table) {
            $table->dropForeign('interests_lecture_id_foreign');
        });
        Schema::dropIfExists('interests');
    }
}
