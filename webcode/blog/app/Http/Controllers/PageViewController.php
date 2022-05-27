<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageViewRequest;
use App\Models\PageView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PageViewController extends Controller
{
    public function store(PageViewRequest $request){
        $data = array(
            'current_url' => $request->current_url,
            'referer'=> $request->referer,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'agent' => $_SERVER['HTTP_USER_AGENT'],
            'session_id' => Cookie::get('laravel_session')
        );

        return PageView::Create($data);
    }
}
