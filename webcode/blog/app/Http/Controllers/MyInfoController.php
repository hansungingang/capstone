<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\UserPrefer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MyInfoController extends Controller
{
    public function index(){
        $category = Category::all();
        $sub_category = SubCategory::with('category')->orderBy('count','desc')->orderBy('category_id','asc')->get()->groupBy('category_id');
        $my_info_sub_category = UserPrefer::where('user_id',Auth::id())->pluck('sub_category')->toArray();
        return view('myInfo.index',['category' => $category, 'sub_category' => $sub_category,'my_info_sub_category' => $my_info_sub_category]);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'sub_category' => 'required'
        ]);
        $validated = $validator->validated();
        DB::beginTransaction();
        
        try{
            UserPrefer::where('user_id',Auth::id())->delete();
            foreach($validated['sub_category'] as $key => $value){
                UserPrefer::create([
                    'user_id' => Auth::id(),
                    'sub_category' => $value
                ]);
            }
            $status = '200';
            $message = '성공했습니다.';
            DB::commit();
        }catch(\Exception $ex){
            $status = '404';
            $message = $ex->getMessage();
            DB::rollBack();
        }
        
        return redirect()->back()->with(['status' => $status, 'message'=> $message]);
    }
}
