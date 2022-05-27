@extends('layouts.app')

@section('style')
    <link type="text/css" rel="stylesheet" href="{{asset('css/notice/notice-show.css')}}">
@stop

@section('script')

@stop

@section('content')
<div class="table-responsive" style="text-align:center;">
    <table id="datatable-scroller" class="table table-bordered tbl_Form">
        <colgroup>
            <col width="250px" />
            <col />
        </colgroup>
        <tbody>
            <tr>
                <th class="active" >제목</th>
                <td>
                    {{$notice->title}}
                </td>
            </tr>
            <tr>
                <th class="active" >내용</th>
                <td>
                    @php
                        {{echo stripslashes($notice->content);}}
                    @endphp
                </td>
            </tr>
        </tbody>
    </table>
    @if (Auth::user()->getIsAdminAttribute())
        <div class="float-start">
            <form action="{{route('notice.destroy',['notice'=>$notice])}}" method="POST">
               @csrf
               @method('delete')
               <button type="submit" class="btn btn-primary">삭제하기</a>
           </form>
        </div>
    @endif
    <div class="float-end">
        @if (Auth::user()->getIsAdminAttribute())
            <a href="/notice/edit/{{$notice->id}}" class="btn btn-primary text-white">변경하기</a>
        @endif
        <a href="/notice" class="btn btn-primary text-white">목록가기</a>
    </div>
@stop