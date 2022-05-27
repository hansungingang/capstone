@extends('layouts.app')

@section('style')
    <link type="text/css" rel="stylesheet" href="{{asset('css/board/board-create.css')}}">
@stop

@section('script')

@stop

@section('content')
<div class="row">
    <div class="col">
        <form action="/board" method="post">
            @csrf
            <div class="form-group row">
                <label for="board_category_id" class="col-sm-2 col-form-label">카테고리</label>
                <div class="col-sm-2">
                    <select id="board_category_id" name="board_category_id" class="form-control">
                        @foreach ($boardCategory as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">제목</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
            <div class="form-group row">
                <label for="content" class="col-sm-2 col-form-label">내용</label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="content" id="editor" style="width: 500px; height:100px"></textarea>
                    @include('ckeditor.ckeditor')
                </div>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-primary text-white">등록하기</button>
                <a href="/board" class="btn btn-primary text-white">목록가기</a>
            </div>  
        </form>
    </div>
</div>
@stop