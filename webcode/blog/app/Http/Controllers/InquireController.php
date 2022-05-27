<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquireRequest;
use App\Models\Inquire;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InquireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inquire.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InquireRequest $request)
    {
        DB::beginTransaction();
        try{
            $request->store();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('message','에러가 발생했습니다.'.$ex);    
        }
        return redirect()->back()->with('message','문의가 완료되었습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Inquire $inquire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
}
