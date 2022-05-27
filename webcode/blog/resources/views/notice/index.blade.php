@extends('layouts.app')

@section('style')
    <link type="text/css" rel="stylesheet" href="{{asset('css/notice/notice-index.css')}}">
@stop

@section('script')
<script>
    const msg = '{{Session::get('message')}}';
      const exist = '{{Session::has('message')}}';
      if(exist){
        alert(msg);
      }
</script>
@stop

@section('content')
<div class="customerCenter">
    <div class="d-flex justify-content-center">
        <a href="/inquire">1:1문의</a>
        &nbsp;
        <a href="/notice" class="text-white bg-success">공지</a>
    </div>
    <br>
</div>
<div class="row">
    <div class="col">
        <span class="title">공지사항 목록</span>
        <div class="float-end">
            <form action="/notice" method="get">
                <div class="row">
                    <div class="col-3">
                        <input type="text" class="form-control" aria-label="Text input with segmented dropdown button" name="search" value="{{!empty($search) ? $search : null}}">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary" id="button">조회</button>
                    </div>
                    <div class="col-3">
                        <a href="/notice" class="btn btn-primary text-white">되돌리기</a>
                    </div>
                    <div class="col-3">
                    @if (Auth::check() && Auth::user()->getIsAdminAttribute())                            
                        <a href="/notice/create" class="btn btn-primary"><span class="text-white">등록</span></a>
                    @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th style="width:10%">번호</th>
            <th style="width:30%">제목</th>
            <th style="width:30%">등록일</th>
            <th style="width:20%">조회수</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($notice as $item)
            <tr>
                <th scope="row">{{$item['id']}}</th>
                <td><a href="/notice/show/{{$item['id']}}">{{$item['title']}}</a></td>
                <td>{{$item['created_at']}}</td>
                <td>{{$item['count']}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">공지사항이 없습니다.</td>
            </tr>
        @endforelse 
    </tbody>
</table>

<div class="d-flex">
    {!! $notice->links() !!}
</div>
@stop