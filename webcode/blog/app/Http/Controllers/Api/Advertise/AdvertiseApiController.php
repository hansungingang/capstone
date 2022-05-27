<?php

namespace App\Http\Controllers\Api\Advertise;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdMappingRequest;
use App\Http\Requests\InquireAnswerRequest;
use App\Models\AdArea;
use App\Models\AdMapping;
use Exception;
use Illuminate\Support\Facades\DB;

class AdvertiseApiController extends Controller{
    function getAllAdvertiseAreas(){
        return response()->json(['data' => AdArea::all()]);
    }

    function getMappingListByAdvertiseId(AdArea $adArea){
        return response()->json(['data' => AdMapping::where('ad_area_id',$adArea->id)->orderBy('id','desc')->get()]);
    }

    function storeMappingList(AdMappingRequest $adMappingRequest,AdArea $adArea){
        try{
            DB::beginTransaction();
            $adMappingRequest->store($adArea);
            DB::commit();
        }catch(Exception $ex){
            DB::rollback();
        }
        
        return response()->json(['data' =>AdMapping::where('ad_area_id',$adArea->id)->orderBy('id','desc')->get()]);
    }

    function deleteMapping(AdMapping $adMapping){
        try{
            DB::beginTransaction();
            $adMapping->delete();
            DB::commit();
        }catch(Exception $ex){
            DB::rollback();
        }
        return response()->json(['data' =>AdMapping::where('ad_area_id',$adMapping->ad_area_id)->orderBy('id','desc')->get()]);
    }
}