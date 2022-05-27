<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lecture_id');
            $table->unsignedBigInteger('ad_area_id');
            $table->timestamps();

            $table->foreign('lecture_id')->references('id')->on('lectures');
            $table->foreign('ad_area_id')->references('id')->on('ad_areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_mappings', function (Blueprint $table) {
            $table->dropForeign('ad_mappings_lecture_id_foreign');
        });
        Schema::table('ad_mappings', function (Blueprint $table) {
            $table->dropForeign('ad_mappings_ad_area_id_foreign');
        });
        Schema::dropIfExists('ad_mappings');
    }
}
