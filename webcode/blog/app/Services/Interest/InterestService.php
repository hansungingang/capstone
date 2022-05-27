<?php

namespace App\Services\Interest;

use App\Http\Requests\InterestRequest;
use App\Models\Interest;
use Illuminate\Support\Facades\Auth;

class InterestService{
    public function store(InterestRequest $request){
        return Interest::Create(['user_id'=> Auth::id(),'lecture_id'=> (int)$request->lecture_id]);
    }

    public function get($lecture_id){
        return Interest::where('user_id',Auth::id())->where('lecture_id',(int)$lecture_id)->first();
    }

    public function getWhereIn($lecture_ids){
        return Interest::whereIn('lecture_id',$lecture_ids)->where('user_id',Auth::id());
    }
}
?>