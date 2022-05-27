<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('board_category_id');
            $table->integer('count')->default('0');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('board_category_id')->references('id')->on('board_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boards', function (Blueprint $table) {
            $table->dropForeign('boards_user_id_foreign');
        });
        Schema::table('boards', function (Blueprint $table) {
            $table->dropForeign('boards_board_category_id_foreign');
        });
        Schema::dropIfExists('boards');
    }
}
