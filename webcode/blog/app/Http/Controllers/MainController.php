<?php

namespace App\Http\Controllers;

use App\Models\AdArea;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $ads = AdArea::with('adMapping.lecture.file','adMapping.lecture.platform')->get()->toArray();
        return view('welcome')->with(['ads' => $ads]);
    }
}
