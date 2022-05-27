<?php

use App\Models\BoardCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBoardCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        if(DB::table('board_categories')->count() == 0){
            DB::table('board_categories')->insert([
                ['name' => '개발'],
                ['name' => '비즈니스'],
                ['name' => '운동/건강'],
                ['name' => '라이프스타일'],
                ['name' => '사진/영상'],
                ['name' => '디자인'],
                ['name' => '교육'],
                ['name' => '음악'],
                ['name' => '재테크']
            ]);
        }else{
            echo "BoardCategory Already Exists"; 
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('board_categories')->delete();
        Schema::dropIfExists('board_categories');
    }
}
