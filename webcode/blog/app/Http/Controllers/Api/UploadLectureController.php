<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\LectureRequest;
use App\Services\Image\ImageService;
use Exception;
use Illuminate\Support\Facades\DB;

class UploadLectureController extends Controller
{
    public function uploadThumbNail(ImageRequest $request,ImageService $imageService)
    {
        DB::beginTransaction();
        try{
            $result = $imageService->uploadToS3($request)->id;
            $message = '성공하였습니다.';
            DB::commit();
        }catch(Exception $ex){
            $result = null;
            $message = '에러가 발생하였습니다.';
            DB::rollBack();
            return response()->json(['message'=>$message]);
        }

        return response()->json(['id'=>$result,'message'=>$message]);
    }

    public function uploadLecture(LectureRequest $request){
        DB::beginTransaction();
        try {
            $result = $request->store($request);
            DB::commit();
            $message = '성공하였습니다.';
        } catch (Exception $ex) {
            DB::rollBack();
            $result = null;
            $message = '에러가 발생하였습니다.';
            return response()->json(['id'=>$result,'message'=>$ex->getMessage()],401);
        }

        return response()->json(['id'=>$result,'message'=>$message],200);
    }
}
