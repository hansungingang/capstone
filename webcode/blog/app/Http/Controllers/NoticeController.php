<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use App\Http\Requests\NoticeUpdateRequest;
use App\Models\Notice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search){
            $notice = Notice::where('title','like','%'.$request->search.'%')->orderBy('id','DESC')->paginate(10);
        }else{
            $notice = Notice::orderBy('id','DESC')->paginate(10);
        }
        return view('notice.index',['notice' => $notice, 'search' => $request->search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticeRequest $request)
    {
        DB::beginTransaction();
        try{
            $notice = $request->store();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('message','에러가 발생했습니다.'.$ex);    
        }
        return redirect()->route('notice.show',['notice'=>$notice]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        Notice::where('id',$notice->id)->update(['count'=> $notice->count+1 ]);
        return view('notice.show',compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        return view('notice.edit',['notice' => $notice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoticeRequest $request, Notice $notice)
    {
        DB::beginTransaction();
        try{
            $request->update($notice);
            $message = '성공하였습니다.';
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            $message = '실패하였습니다.';
        }
        
        return redirect()->route('notice.show',['notice'=>$notice])->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        DB::beginTransaction();
        try{
            $notice->delete();
            DB::commit();
            $message = '성공하였습니다.';
        }catch(Exception $ex){
            DB::rollBack();
            $message = '실패하였습니다.';
            return response()->back()->with('message',$message);
        }

        return redirect()->route('notice.index')->with('message',$message);
    }
}
