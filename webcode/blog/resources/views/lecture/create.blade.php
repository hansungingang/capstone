@extends('layouts.app')

@section('style')
    <link type="text/css" rel="stylesheet" href="{{asset('css/lecture/lecture-create.css')}}">
@stop
@section('script')
    <script type="text/javascript" src="{{asset('js/lecture/lecture-create.js')}}" charset="utf-8"></script>
    <script>
        const msg = '{{Session::get('alert')}}';
        const exist = '{{Session::has('alert')}}';
        if(exist){
          alert(msg);
        }
      </script>
@stop

@section('content')
<h1> 강의등록하기</h1>

<form method="POST" action="{{ route('lecture.store')}}" id="upload_lecture">
    @csrf

    <div class="container">
        <div class="row">
            <span>강의 정보</span>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <input type="hidden" name="file_id" id="file_id" class="file_id" value="">
                <img id="output_image" width="100%" height="300px" alt="">
                <label for="upload_image" style="cursor: pointer;">강의 프로필 이미지 파일을 선택하세요.</label>
                <div class="float-end">
                    <input type="file" accept="image/*" id="upload_image" name="upload_image" placeholder="사진 추가" onchange="loadfile(event)">
                </div>
                <br>
                <button type="button" class="btn btn-primary" id="add_platform" name="add_platform">플랫폼 정보 추가</button>
            </div>
            <div class="col-sm-4">
                <div class="lecture_info_write">
                    <label for="name">강의 이름</label>
                    <br>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <br>

                    <label for="instructor_name">강사 이름</label>
                    <br>
                    <input type="text" class="form-control" id="instructor_name" name="instructor_name" required>
                    <br>

                    <label for="instructor_name">카테고리</label>
                    <br>
                    <label for="category_id">

                    </label>
                    <select id="category_id" name="category_id" class="form-control">
                        @foreach ($category as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col">
                <div class="add_platform_place">
                </div>
            </div>
        </div>
        <div class="row">
            <span>상세정보</span>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col align-self-center">
                <label for="editor"></label>
                <textarea class="form-control" rows="20" cols="50" name="content" id="editor" style="width:700px; height:400px;"></textarea>
                @include ('ckeditor.ckeditor')
            </div>
            <div class="col-sm-2"></div>
        </div>
        <br>
        <div class="float-end">
            <button type="submit" class="btn btn-primary">등록</button>
        </div>
    </div>
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@stop
