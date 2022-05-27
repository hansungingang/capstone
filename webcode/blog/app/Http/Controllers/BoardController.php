<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Models\Board;
use App\Models\BoardCategory;
use App\Models\Category;
use App\Models\Comment;
use App\Services\Board\BoardService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(){
        $this->middleware('auth',['except' => [
            'index','show'
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request,BoardService $boardService)
    {
        if($request->board_category_id){
            $current = BoardCategory::where('id',$request->board_category_id)->first();
        }else{
            $current = null;
        }

        return view('board.index')->with(['category'=> Category::all(),'current' => $current, 'boards' => $boardService->search($request)]);
    }

    public function create()
    {
        return view('board.create',['boardCategory' => BoardCategory::all()]);
    }

    public function store(BoardRequest $request)
    {
        DB::beginTransaction();
        try{
            $board = $request->store();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('message','에러가 발생했습니다.'.$ex);    
        }
        return redirect()->route('board.show',['board'=>$board]);
    }

    public function show(Board $board)
    {
        Board::where('id',$board->id)->update(['count'=> $board->count+1 ]);
        $boardCategoryName = BoardCategory::where('id',$board->board_category_id)->first()->name;
        $comments = Comment::with('user','subcomments')->where('parent_comment_id',0)->where('board_id',$board->id)->orderBy('id','desc')->get();
        return view('board.show',compact('board','boardCategoryName','comments'));
    }

    public function edit(Board $board)
    {
        return view('board.edit',['board' => $board, 'boardCategory' => BoardCategory::all()]);
    }

    public function update(BoardRequest $request, Board $board)
    {
        DB::beginTransaction();
        try{
            if(Auth::id() == $board->user_id){
                $request->update($board);
            }else{
                throw new Exception('유저가 다릅니다.');
            }
            
            $message = '성공하였습니다.';
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            $message = '실패하였습니다.'. $ex;
        }
        
        return redirect()->route('board.show',['board'=>$board])->with('message',$message);
    }

    public function destroy(Board $board)
    {
        DB::beginTransaction();
        try{
            if(Auth::id() == $board->user_id){
                $board->delete();
            }else{
                throw new Exception('유저가 다릅니다.');
            }
            DB::commit();
            $message = '성공하였습니다.';
        }catch(Exception $ex){
            DB::rollBack();
            $message = '실패하였습니다.'.$ex;
            return response()->back()->with('message',$message);
        }

        return redirect()->route('board.index')->with('message',$message);
    }
}
