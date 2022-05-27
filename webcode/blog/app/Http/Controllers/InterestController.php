<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterestRequest;
use App\Http\Requests\MultipleInterestRequest;
use App\Models\Interest;
use App\Models\Lecture;
use App\Services\Interest\InterestService;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterestController extends Controller
{
    public function index()
    {
        $lectures = Lecture::with('file','platform')->whereHas('interests',function($query){
            $query->where('user_id',Auth::id());
        })->get();

        return view('interest.index',['lectures' => $lectures]);
    }

    public function store(InterestRequest $request, InterestService $interestService)
    {
        try{ 
            if($interestService->get($request->lecture_id,Auth::id()) === null ){
                $lecture = $interestService->store($request);
                $status = 200;
                $message = null;
            }else{
                throw new \Exception('이미 저장이 되어 있는 에러');
            }
        }catch(Exception $ex){
            $lecture = null;
            $status = 404;
            $message = $ex->getMessage();
        }

        return response()->json(['data' => $lecture, 'status' => $status,'message' => $message]);
    }

    public function destroy(Request $request,InterestService $interestService)
    {
        try{
            $interest = $interestService->get((int)$request->lecture_id);
            if($interest == null){
                throw new Error('목록 없음.');
            }else{
                $interest->delete();
                $status = 200;
                $message = 'success';
            }
        }catch(Exception $ex){
            $status = 404;
            $message = $ex->getMessage();
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function multipleDestroy(MultipleInterestRequest $request, InterestService $interestService){
        try{
            $interests = $interestService->getWhereIn($request->lecture_ids);
            if(!empty($interests)){
                if($interests->delete()){
                    $status = 200;
                    $message = 'success';
                }else{
                    throw new Error('삭제 실패.');    
                }
            }else{
                throw new Error('목록 없음.');
            }

        }catch(Exception $ex){
            $status = 404;
            $message = $ex->getMessage();
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function isInterested($lecture_id){
        $interest = Interest::where('lecture_id',$lecture_id)->where('user_id',Auth::id());
        if(!empty($interest)){
            $status = 200;
            $message = 'success';
        }else{
            $status = 404;
            $message = 'fail';
        }

        return response()->json(['message' => $message, 'status' => $status]);
    }
}
