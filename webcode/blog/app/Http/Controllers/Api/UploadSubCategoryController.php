<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;
use Exception;
use Illuminate\Support\Facades\DB;

class UploadSubCategoryController extends Controller
{
    public function uploadSubCategory(SubCategoryRequest $request){
        DB::beginTransaction();
        try {
            $subCategory = SubCategory::where(['name'=>$request->name,'category_id'=>$request->category_id])->first();
            if($subCategory != null){
                $subCategory->count = $subCategory->count + 1 ;
                $subCategory->save();
            }else{
                $request->store();
            }
            DB::commit();
            $message = '성공하였습니다.';
        } catch (Exception $ex) {
            DB::rollBack();
            $message = '에러가 발생하였습니다.';
            return response()->json(['message'=>$message],401);
        }

        return response()->json(['message'=>$message,'subCategory'=>SubCategory::where(['name'=>$request->name,'category_id'=>$request->category_id])->first()],200);
    }
}
