<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_areas', function (Blueprint $table) {
            $table->id();
            $table->string('area_code');
            $table->string('area_name');
            $table->timestamps();
        });

        if(DB::table('ad_areas')->count() == 0){
            DB::table('ad_areas')->insert([
                ['area_code' => 'AD001','area_name'=>'메인배너'],
                ['area_code' => 'AD002','area_name'=>'메인배너2'],
                ['area_code' => 'AD003','area_name'=>'메인배너3'],
                ['area_code' => 'AD004','area_name'=>'메인배너4'],
                ['area_code' => 'AD005','area_name'=>'메인배너5'],
                ['area_code' => 'AD006','area_name'=>'메인배너6'],
            ]);
        }else{
            echo "ad_areas Already Exists"; 
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_areas');
    }
}
