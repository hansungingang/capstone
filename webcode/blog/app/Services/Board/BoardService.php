<?php

namespace App\Services\Board;

use App\Models\Board;
use App\Models\Comment;
use Illuminate\Http\Request;

class BoardService{
    public function search(Request $request){
        $result = Board::with('user');
        if(!empty($request->board_category_id)){
            $result = $result->where('id',$request->board_category_id);
        }

        if (isset($request->search)) {
            $result = $result->where('title', 'like', '%' . $request->search . '%');
        }

        $result = $result->orderBy('id','desc')->paginate(10);

        return $result;
    }
}
