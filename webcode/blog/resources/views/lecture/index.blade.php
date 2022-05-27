@extends('layouts.app')

@section('style')
<link type="text/css" rel="stylesheet" href="{{asset('css/lecture/lecture-index.css')}}">
@stop

@section('script')
<script type="text/javascript" src="{{asset('js/lecture/lecture-index.js')}}" charset="utf-8"></script>
@stop

@section('content')
<div class="d-flex justify-content-start">
  <nav class="navbar-light bg-light">
    <div class="container">
      <p>카테고리</p>
      <p>
        <a class="btn btn-light" data-bs-toggle="collapse" href="#navbarDropdownMenuLink" role="button" aria-expanded="false" aria-controls="collapseExample1">
          {{ $category_name }}
        </a>
      </p>
      <div class="collapse" id="navbarDropdownMenuLink">
        <div>
          @if(!empty($lecture_sub_category))
            @foreach($lecture_sub_category as $value)
              <a class="dropdown-item" href="/lecture?category_id={{$lecture_category['id']}}&&name={{$value['name']}}">{{$value['name']}}({{$value['count']}})</a>
            @endforeach
          @else
            @foreach($lecture_category as $value)
              <a class="dropdown-item" href="/lecture?category_id={{$value['id']}}">{{$value['name']}}</a>
            @endforeach
          @endif
        </div>
      </div>
      <p>
        <a class="btn btn-light" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          브랜드
        </a>
      </p>
      <div class="collapse" id="collapseExample">
        <div>
          <ul class="nav flex-column">브랜드
            <div class="form-check">
              @foreach ($lecture_platform as $key => $item)
              <li>
                <input class="form-check-input" type="checkbox" value="{{$item['platform_name']}}" id="flexCheckDefault{{$key}}">
                  <label class="form-check-label" for="flexCheckDefault{{$key}}">
                  {{$item['platform_name']}}
                  </label>
              </li>    
              @endforeach
            </div>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div id="table_data"></div>
</div>

@stop