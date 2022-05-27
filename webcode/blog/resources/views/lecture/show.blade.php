@extends('layouts.app')

@section('style')
<link type="text/css" rel="stylesheet" href="{{asset('css/lecture/lecture-show.css')}}">
@stop

@section('script')
<script type="text/javascript" src="{{asset('js/lecture/lecture-show.js')}}" charset="utf-8"></script>
@stop

@section('content')
<input type="hidden" value="{{ $lecture_id }}" id="lecture_id">
<fieldset class="simple_info">
    <legend>간단 정보</legend>
    <div class="d-flex justify-content-start">
        <div class="container">
            <div>
                <img src="/file/imageDownload/{{$lecture_content[0]['file']['id']}}" class="img-thumbnail" width="400px" height="500px">
                <ul class="float-end">
                    <p>상품이름 : {{$lecture_content[0]['name']}}</p>
                    <p>강사이름 : {{$lecture_content[0]['instructor_name']}} </p>
                    @if(Auth::user() && Auth::user()->is_admin)
                    <a href="/lecture/edit/{{$lecture_content[0]['id']}}">강의 변경</a>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <br>
</fieldset>
<fieldset class="platform_info">
    <legend>플랫폼 정보</legend>
    <div class="d-flex justify-content-center">
        <table class="table table-borderless">
            @foreach ($lecture_content[0]['platform'] as $item)
            <thead>
                <tr>
                    <th scope="col">플랫폼이름</th>
                    <th scope="col">가격</th>
                    <th scope="col">URL</th>
                    <th scope="col">시청가능기간</th>
                    <th scope="col">강의종료시간</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$item['platform_name']}}</td>
                    <td>{{$item['price']}}</td>
                    <td><a href="{{$item['url']}}">{{$item['url']}}</a></td>
                    <td>{{$item['watch_time'] ? $item['watch_time'].'일' : '무제한'}}</td>
                    <td>{{$item['end_time'] ? $item['end_time'] : '없음'}}</td>
                </tr>
            </tbody>
            <br>
            @endforeach
        </table>
    </div>
</fieldset>
<fieldset class="detail_info">
    <legend>상세정보</legend>
    <div class="d-flex justify-content-center">
        @php
        echo stripslashes($lecture_content[0]['content']);
        @endphp
    </div>
</fieldset>
<fieldset class="review">
    <legend>리뷰</legend>
    <div class="d-flex justify-content-start paddingLR240">
        <button type="button" id="ingangdamoa_review" class="btn btn-success" onclick="ingangDamoaSetColor(this)">인강 다모아 리뷰</button>
        <button type="button" id="platform_review" class="btn" onclick="platformSetColor(this)">해당 플랫폼 리뷰</button>
    </div>
    <div class="d-flex justify-content-start">
        <form action="/review/{{$lecture_id}}" method="post" id="review">
            @csrf
            <div class="container paddingLR240">
                <div id="divToggle">
                    <div class="d-flex justify-content-start">
                        <textarea class="form-control" name="content" id="editor" style="width: 500px; height:100px"></textarea>
                        @include ('ckeditor.ckeditor')
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <div class="star-rating space-x-4 mx-auto">
                                <input type="radio" name="difficulty" value="5" id="5" v-model="dificulties">
                                <label for="5">★</label>

                                <input type="radio" name="difficulty" value="4" id="4" v-model="dificulties">
                                <label for="4">★</label>

                                <input type="radio" name="difficulty" value="3" id="3" v-model="dificulties">
                                <label for="3">★</label>

                                <input type="radio" name="difficulty" value="2" id="2" v-model="dificulties">
                                <label for="2">★</label>

                                <input type="radio" name="difficulty" value="1" id="1" v-model="dificulties">
                                <label for="1">★</label>
                                <h2>난이도</h2>
                            </div>
                        </div>
                        &nbsp;
                        <div class="star-rating space-x-4 mx-auto">
                            <input type="radio" id="5-stars" name="star" value="5" v-model="stars" />
                            <label for="5-stars" class="star">★</label>

                            <input type="radio" id="4-stars" name="star" value="4" v-model="stars" />
                            <label for="4-stars" class="star">★</label>

                            <input type="radio" id="3-stars" name="star" value="3" v-model="stars" />
                            <label for="3-stars" class="star">★</label>

                            <input type="radio" id="2-stars" name="star" value="2" v-model="stars" />
                            <label for="2-stars" class="star">★</label>

                            <input type="radio" id="1-star" name="star" value="1" v-model="stars" />
                            <label for="1-star" class="star">★</label>
                            <h2>별점</h2>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">리뷰등록</button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <table id="result" class="table table-striped">
                            <tbody></tbody>
                        </table>
                    </div>
                    <div id="page">
                    </div>
                </div>
            </div>
        </form>
    </div>
</fieldset>
@stop