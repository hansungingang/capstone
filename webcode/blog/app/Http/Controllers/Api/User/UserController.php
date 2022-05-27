<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller{
    function getAllUser(){
        return response()->json(['data' => User::orderBy('id','desc')->get()]);
    }

    function getOneUser(User $user){
        return response()->json(['data'=> $user]);
    }

    function updateUser(UserRequest $request,user $user){
        return response()->json(['data'=> $request->update($user)]);
    }

    function searchByEmail(Request $request){
        $request->validate([
            'email' => 'required'
        ]);
        return response()->json(['data' => User::where('email', 'like', '%' . $request->email . '%')->get()]);
    }
}