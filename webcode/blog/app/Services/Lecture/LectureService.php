<?php

namespace App\Services\Lecture;

use App\Http\Requests\LectureRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Interest;
use App\Models\Lecture;
use App\Models\LecturePlatform;
use Illuminate\Support\Facades\Auth;

class LectureService{
    public function search(SearchRequest $request){
        $list = 10;
        $result = Lecture::with('file', 'platform');
        
        if (!empty($request->category_id) && ($request->category_id != "null")) {
            $category_id = (int)$request->category_id;
            $result = $result->where('category_id', $category_id);
        }

        $brands = $request->brands;
        if ((is_array($brands) && count($brands) > 0)) {
            $result = $result->whereHas('platform', function ($query) use ($brands) {
                foreach ($brands as $key => $value) {
                    if ($key == key($brands)) {
                        $query->where('platform_name', $value);
                    } else {
                        $query->orWhere('platform_name', $value);
                    }
                }
            });
        }

        if (!empty($request->search)) {
            $result = $result->where('name', 'like', '%' . $request->search . '%');
        }else if(!empty($request->name)&& ($request->name != 'null')){
            $result = $result->where('name', 'like', '%' . $request->name . '%');
        }

        $result = $result->orderBy('id', 'desc')->skip($list * $request->page)->take($list)->paginate(10)->toArray();
        
        foreach($result['data'] as $key => $item){
            $result['data'][$key]['heart'] = Interest::where('lecture_id',$item['id'])->where('user_id',Auth::id())->count();
        }
        return $result;
    }
}
?>