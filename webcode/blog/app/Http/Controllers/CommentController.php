<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Board;
use App\Models\Comment;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index(Board $board){
        return response()->json(['data'=>$this->getBoardCommentWithSubComment($board->id)]);
    }

    public function store(CommentRequest $request,Board $board){
        DB::beginTransaction();
        try{
            $comment = $request->store($board);
            $message = '댓글 작성 완료했습니다.';
            $status = 200;
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            $message = '에러가 발생했습니다.'.$ex;
            $status = 404;
        }
        return response()->json(['message'=>$message,'status'=>$status]);
    }

    public function update(CommentRequest $commentRequest ,Comment $comment){
        DB::beginTransaction();
        try{
            if(Auth::id() == $comment->user_id){
                $commentRequest->update($comment);
            }else{
                throw new Exception('유저가 다릅니다.');
            }
            
            $message = '댓글 변경 완료하였습니다.';
            $status=200;
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            $message = '실패하였습니다.'. $ex;
            $status = 404;
        }
        
        return response()->json(['message'=>$message,'status'=>$status]);
    }

    public function destroy(Comment $comment){
        DB::beginTransaction();
        try{
            if(Auth::id() == $comment->user_id){
                $comment->subcomments()->delete();
                $comment->delete();   
            }else{
                throw new Exception('유저가 다릅니다.');
            }
            DB::commit();
            $status = 200;
            $message = '댓글을 삭제하였습니다.';
        }catch(Exception $ex){
            DB::rollBack();
            $message = '실패하였습니다.'.$ex;
            $status = 404;
        }

        return response()->json(['message'=>$message,'status'=>$status]);
    }

    private function getBoardCommentWithSubComment($board_id){
        return Comment::with(['user' => function ($query) {
            $query->select('id','type', 'name');
        }])->with('subcomments.user')->where('board_id',$board_id)->where('parent_comment_id',0)->orderBy('id','desc')->get();
    }
}
