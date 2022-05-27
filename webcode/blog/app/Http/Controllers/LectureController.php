<?php

namespace App\Http\Controllers;

use App\Http\Requests\LectureRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Interest;
use App\Models\Lecture;
use App\Models\LecturePlatform;
use App\Models\SubCategory;
use App\Services\Cookie\CookieService;
use App\Services\Lecture\LectureService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class LectureController extends Controller
{

    public function __construct(){
        $this->middleware('auth',['except' => [
            'index','show','index_ajax_data','getLecture'
        ]]);
    }

    public function index(Request $request)
    {
        $list = 10;
        $lecture = Lecture::with('file','interests')->orderBy('id', 'desc')->skip(0)->take($list)->paginate(10)->toArray();
        $lecture_platform = LecturePlatform::distinct()->get(['platform_name']);        

        if (!empty($request->category_id) && is_int((int)$request->category_id)) {
            $category_name = Category::find($request->category_id)->name;
            $lecture_sub_category = SubCategory::where('category_id',$request->category_id)->get();
            foreach($lecture_sub_category as $key => $value){
                $lecture_sub_category[$key]['count'] = Lecture::where('category_id',$request->category_id)->where('name', 'like', '%' . $value['name'] . '%')->count();
            }
            $lecture_sub_category = collect($lecture_sub_category)->sortByDesc('count')->all();
            $lecture_category = Category::where('id',$request->category_id)->first()->toArray();
        } else {
            $category_name = '전체';
            $lecture_sub_category = null;
            $lecture_category = Category::all();
        }

        return view('lecture.index')->with([
            'lecture' => $lecture,
            'lecture_platform' => $lecture_platform, 
            'category_name' => $category_name,
            'lecture_category' => $lecture_category,
            'lecture_sub_category' => $lecture_sub_category
        ]);
    }

    public function index_ajax_data(SearchRequest $request,LectureService $lectureService)
    {
        if ($request->ajax()) {
            return $lectureService->search($request);
        }
    }

    public function create()
    {
        return view('lecture.create')->with(['category' => Category::all()]);
    }

    public function show(Lecture $lecture,CookieService $cookieService)
    {
        $cookieService->storeTenRecent($lecture);
        $lecture_content = Lecture::with('platform','file')->where('id',$lecture->id)->get()->toArray();
        return view('lecture.show',['lecture_id'=>$lecture->id,'lecture_content'=>$lecture_content]);
    }

    public function edit(Lecture $lecture){
        return view('lecture.edit')->with(['category' => Category::all(),'lecture_id'=> $lecture->id]);
    }

    public function getLecture(Lecture $lecture)
    {
        return Lecture::where('id',$lecture->id)->with('platform','file')->get()->toArray();
    }

    public function store(LectureRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->store();
            DB::commit();
            $error = null;
        } catch (Exception $ex) {
            DB::rollBack();
            $error = $ex;
            return redirect::back()->with('alert', '에러 발생' . $error);
        }

        return Redirect::back()->with('alert', '저장 완료!');
    }

    public function update(LectureRequest $request, Lecture $lecture){
        DB::beginTransaction();
        try {
            $request->update($lecture);
            DB::commit();
            $error = null;
        } catch (Exception $ex) {
            DB::rollBack();
            $error = $ex;
            return redirect::back()->with('alert', '에러 발생' . $error);
        }

        return Redirect::back()->with('alert', '변경 완료!');
    }
}
