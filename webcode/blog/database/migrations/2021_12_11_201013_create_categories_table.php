<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code_name');
        });

        if(DB::table('categories')->count() == 0){
            DB::table('categories')->insert([
                ['name' => '개발','code_name'=>'CT001'],
                ['name' => '비즈니스','code_name'=>'CT002'],
                ['name' => '운동/건강','code_name'=>'CT003'],
                ['name' => '라이프스타일','code_name'=>'CT004'],
                ['name' => '사진/영상','code_name'=>'CT005'],
                ['name' => '디자인','code_name'=>'CT006'],
                ['name' => '교육','code_name'=>'CT007'],
                ['name' => '음악','code_name'=>'CT008'],
                ['name' => '재테크','code_name'=>'CT009'],
            ]);
        }else{
            echo "LectureCategory Already Exists"; 
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->delete();
        Schema::dropIfExists('categories');
    }
}
