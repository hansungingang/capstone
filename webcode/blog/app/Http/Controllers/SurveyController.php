<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyRequest;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function create(){
        return view('survey.create');
    }

    public function store(SurveyRequest $request){
        Survey::create($request->all());

        return redirect()->route('survey.create')->with('alert','설문에 참여해주셔서 감사합니다.');
    }
}
