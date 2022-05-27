<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Lecture;
use App\Models\Review;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['except' => [
            'index','show'
        ]]);
    }
    
    function index(Lecture $lecture){
        $list = 10;
        return response()->json([
            'data' => Review::with('user:id,name,type')->where('lecture_id',$lecture->id)->orderBy('id', 'desc')->skip(0)->take($list)->paginate(10)->toArray(),
            'current_user' => Auth::user()
        ]);
    }

    function store(ReviewRequest $request,Lecture $lecture){
        DB::beginTransaction();
        try{
            $request->store($lecture);
            DB::commit();
            $status = '200';
            $message = '성공하였습니다.';
        }catch(Exception $ex){
            DB::rollBack();
            $status = '404';
            $message = $ex;
        }

        return redirect()->back()->with(['status'=>$status,'message'=>$message]);
    }

    function update(Request $request,Review $review){
        DB::beginTransaction();
        try{
            $review->update($request->all());
            DB::commit();
            $status='200';
            $message='성공하였습니다.';
        }catch(Exception $ex){
            DB::rollback();
            $status='404';
            $message=$ex;
        }

        return redirect()->back()->with(['status'=>$status,'message'=>$message]);

    }

    function destory(Review $review){
        DB::beginTransaction();
        try{
            $review->delete();
            DB::commit();
            $status = '200';
            $message = '성공하였습니다.';
        }catch(Exception $ex){
            DB::rollback();
            $status='404';
            $message=$ex;
        }

        return response()->json(['status'=>$status , 'message' => $message]);
    }
}
