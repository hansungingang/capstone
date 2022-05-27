<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('instructor_name');
            $table->string('content');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('file_id');

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('file_id')->references('id')->on('files');
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
        Schema::table('lectures', function (Blueprint $table) {
            $table->dropForeign('lectures_category_id_foreign');
        });
        Schema::table('lectures', function (Blueprint $table) {
            $table->dropForeign('lectures_file_id_foreign');
        });
        Schema::dropIfExists('lectures');
    }
}
