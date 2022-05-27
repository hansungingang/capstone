<?php

namespace App\Http\Controllers\Api\Lecture;

use App\Http\Controllers\Controller;
use App\Models\AdMapping;
use App\Models\Lecture;

class LectureApiController extends Controller{
    function getAllLectures(){
        $usedLectureLists = AdMapping::where('id' ,'>' ,0)->pluck('lecture_id')->toArray();
        return response()->json(['data' => Lecture::whereNotIn('id',$usedLectureLists)->orderBy('id','desc')->get()]);
    }
}