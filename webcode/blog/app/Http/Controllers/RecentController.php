<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use Illuminate\Support\Facades\Cookie;

class RecentController extends Controller
{
    function index(){
        $recently_viewed = json_decode(Cookie::get('recently_viewed'));
        $lectures = [];
        
        if(!empty($recently_viewed)){
            foreach ($recently_viewed as $key => $value) {
                if(Lecture::with('file','platform')->where('id',$value)->first()){
                    $lectures[$key] = Lecture::with('file','platform')->where('id',$value)->first()->toArray();
                }
            }
        }
    
        return view('recent.pagination',['lectures'=>$lectures]);
    }
}
