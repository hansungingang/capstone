@extends('layouts.app')

@section('style')
    <link type="text/css" rel="stylesheet" href="{{asset('css/board/board-index.css')}}">
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
<div class="d-flex justify-content-around">
    <div class="d-flex justify-content-start">
        <ul class="nav flex-column">
            @foreach($category as $key => $value)
                <li class="nav-item">
                    <a class="nav-link" href="/board?board_category_id={{$value['id']}}">{{$value['name']}} 게시판</a>
                </li>
            @endforeach
        </ul>
    </div>
    
    <div class="container padding-bottom-160">
        <h2 class="text-center padding-bottom-160">{{ !empty($current) ? $current->name : null}} 게시판</h2>
        
        <div class="container">
            <div class="row">
                <div class="col">
                    <span class="title">게시판 목록</span>
                        <div class="float-end">
                            <form action="/board" method="get" class="row g-2">
                                <div class="col-auto">
                                    <input type="text" class="form-control" aria-label="Text input with segmented dropdown button" name="search" value="{{!empty($search) ? $search : null}}">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary text-white button-width-all">조회</button>
                                </div>
                                <div class="col-auto">
                                    <a href="/board" class="btn btn-primary text-white">되돌리기</a>
                                </div>
                                <div class="col-auto">
                                @if (Auth::check())
                                    <a href="/board/create" class="btn btn-primary"><span class="text-white">등록</span></a>
                                @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>게시판명</th>
                        <th>등록자</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boards as $item)
                        <tr>
                            <td>{{$item['id']}}</td>
                            <td><a href="/board/{{$item['id']}}">{{$item['title']}}</a></td>
                            <td>{{$item['user'][0]['name']}}</td>
                            <td>{{$item['created_at']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex">
                {!! $boards->links() !!}
            </div>
        </div>
    </div>
</div>
@stop