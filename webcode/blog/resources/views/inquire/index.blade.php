@extends('layouts.app')

@section('style')
<link type="text/css" rel="stylesheet" href="{{asset('css/inquire/inquire-index.css')}}">
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
        <a href="/inquire" class="text-white bg-success">1:1문의</a>
        &nbsp;
        <a href="/notice">공지</a>
    </div>
</div>
<br>
<div class="row">
    <div class="col">
        <form action="/inquire" method="post">
            @csrf
            <div class="row g-3 align-items-center">
                <label for="email" class="col-sm-2 col-form-label">이메일</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <label for="title" class="col-sm-2 col-form-label">제목</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <label for="editor" class="col-sm-2 col-form-label">내용</label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="content" id="editor" style="width: 500px; height:100px"></textarea>
                    @include ('ckeditor.ckeditor')
                </div>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-primary">문의하기</button>
            </div>  
        </form>
    </div>
</div>
@stop