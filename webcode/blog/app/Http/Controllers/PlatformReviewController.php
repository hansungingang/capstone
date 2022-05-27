<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlatformReviewRequest;
use App\Models\Lecture;
use App\Models\PlatformReview;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlatformReviewController extends Controller
{

    public function __construct(){
        $this->middleware('auth',['except' => [
            'index','show'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Lecture $lecture)
    {
        return response()->json([
            'data' => PlatformReview::where('lecture_id',$lecture->id)->get(),
            'current_user' => Auth::user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(PlatformReviewRequest $request,Lecture $lecture){
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

        return response()->json(['status'=>$status,'message'=>$message]);
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlatformReview $platformReview)
    {
        DB::beginTransaction();
        try{
            $platformReview->update($request->all());
            DB::commit();
            $status='200';
            $message='성공하였습니다.';
        }catch(Exception $ex){
            DB::rollback();
            $status='404';
            $message=$ex;
        }

        return response()->json(['status'=>$status,'message'=>$message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlatformReview $platformReview)
    {
        DB::beginTransaction();
        try{
            $platformReview->delete();
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
