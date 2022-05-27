<?php

namespace App\Http\Controllers\Api\Inquire;

use App\Http\Controllers\Controller;
use App\Http\Requests\InquireAnswerRequest;
use App\Models\Inquire;
use Illuminate\Http\Request;

class InquireApiController extends Controller{
    function getAllInquiries(){
        return response()->json(['data' => Inquire::orderBy('id','desc')->get()]);
    }

    function getOneInquire(Inquire $inquire){
        return response()->json(['data' => Inquire::find($inquire->id)->first()]);
    }

    function updateOneInquire(InquireAnswerRequest $request, Inquire $inquire){
        return response()->json(['data' => $request->updateAnswer($inquire)]);
    }
}