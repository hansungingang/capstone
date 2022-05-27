@extends('layouts.app')

@section('style')
  <link type="text/css" rel="stylesheet" href="{{asset('css/interest/interest-index.css')}}">
@stop

@section('script')
  <script type="text/javascript" src="{{asset('js/interest/interest-index.js')}}" charset="utf-8"></script>
@stop

@section('content')
  <div class="row">
    <div class="col">
      <button type="button" class="btn btn-danger" id="deleteAll">전체 삭제</button>
    </div>
    <div class="w-100"></div>
    <div class="w-100"></div>
    <div class="col">
      <div class="table-responsive-md">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col"><input type="checkbox" id="delete_all"></th>
              <th scope="col">이미지</th>
              <th scope="col">상품이름</th>
              <th scope="col">강사이름</th>
              <th scope="col">가격</th>
              <th scope="col">URL</th>
              <th scope="col">삭제</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($lectures) && count($lectures) > 0)
              @foreach ($lectures as $item)
                <tr>
                  <th scope="row"><input type="checkbox" class="deleteMany" id="deleteMany" name="checkbox_{{$item['id']}}"></th>
                  <td><a href="lecture/show/{{$item['id']}}"><img src="file/imageDownload/{{$item['file']['id'] }}" width="300" height="200"></a></td>
                  <td><a href="lecture/show/{{$item['id']}}">{{$item['name']}}</a></td>
                  <td>{{$item['instructor_name']}}</td>
                  <td>{{$item['platform'][0]['price']}}</td>
                  <td>{{$item['platform'][0]['url']}}</td>
                  <td><button type="button" class="btn btn-link" id="deleteOne" value="{{ $item['id'] }}">삭제</button></td>
                </tr>
              @endforeach
            @else
              <tr>
                <td>
                </td>
                <td colspan="6">
                  @if(Auth::check())
                    <div>목록이 존재하지 않습니다.</div>
                  @else
                    <div>로그인이 필요합니다.</div>
                  @endif
                </td>
              </tr>            
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@stop
