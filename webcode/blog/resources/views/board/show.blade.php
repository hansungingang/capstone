@extends('layouts.app')

@section('style')
    <link type="text/css" rel="stylesheet" href="{{asset('css/board/board-show.css')}}">
@stop

@section('script')
<script>
    const msg = '{{Session::get('message')}}';
    const exist = '{{Session::has('message')}}';
    if(exist){
        alert(msg);
    }

    var loggedIn = "{{ Auth::check() ? 'true' : 'false' }}";
    var authId = "{{Auth::id()}}";
    var boardId = "{{$board->id}}";
</script>
<script type="text/javascript" src="{{asset('js/board/board-show.js')}}" charset="utf-8"></script>


@stop

@section('content')
<h1>내용</h1>
<div class="text-center">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th class="active col-2">카테고리</th>
                <td>
                    {{$boardCategoryName}}
                </td>
            </tr>
            <tr>
                <th class="active col-2">제목</th>
                <td>
                    {{$board->title}}
                </td>
            </tr>
            <tr>
                <th class="active col-2">내용</th>
                <td>
                    @php
                        {{echo stripslashes($board->content);}}
                    @endphp
                </td>
            </tr>
        </tbody>
    </table>

    @if ((Auth::check() && Auth::user()->getIsAdminAttribute()) || (Auth::id() == $board->user_id))
    <div class="float-start">
        <form action="{{route('board.destroy',['board'=>$board])}}" method="POST">
           @csrf
           @method('delete')
           <button type="submit" class="btn btn-primary text-white">삭제하기</a>
       </form>
    </div>
    @endif
    <div class="float-end">
        @if ((Auth::check() && Auth::user()->getIsAdminAttribute()) || (Auth::id() == $board->user_id))
            <a href="/board/{{$board->id}}/edit" class="btn btn-primary text-white">변경하기</a>
        @endif
        <a href="/board" class="btn btn-primary text-white">목록가기</a>
    </div>
    <br>
    <br>
    <hr>
    <div class="comment">
        <div class="row">
            <div class="col">
                <div class="float-start">
                    <h1>댓글</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form class="form comment-form" id="storeComment">
                    <input type="hidden" name="board_id" id="board_id" value={{$board->id}}>
                    <input type="hidden" name="parent_comment_id" id="parent_comment_id" value="0">
                    <textarea placeholder="Comment" name="content" form="comment" id="comment_content"></textarea>
                    <button type="submit" class="submit" id="comment-upload">등록하기</button>
                </form>

                <div class="area-comment">
                    {{-- @foreach($comments as $key => $item)
                        <div class="comments">
                            <div class="comment">
                                <div class="content">
                                    <header class="top">
                                        <div class="username">{{$item['user']['name']}}</div>
                                        <div class="utility">
                                            @if(Auth::check())
                                            <button class="btn btn-primary text-white" href="#" id="replyButton">답변</button>
                                                @if(Auth::id() == $item['user']['id'])
                                                    <button class="btn btn-primary text-white" href="#" id="changeComment">수정</button>
                                                    <form method="post" action="{{route('comment.destroy',['comment'=>$item['id']])}}">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="submit" class="btn btn-danger" value="삭제">
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </header>
                                    <div class="reply-content"><p>{{$item['content']}}</p></div>
                                    <div class="reply-content-update-form">
                                        <form action="/comment/update/{{$item['id']}}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="text" value="{{$item['content']}}" name='content'>
                                            <input type="submit" class="btn btn-success" value="수정">
                                            <button type='button' id="changeCancel" class="btn btn-danger">취소</button>
                                        </form>
                                    </div>
                                    <ul class="bottom">
                                        <li class="menu time">{{$item['created_at']}}</li>
                                        <li class="divider"></li>
                                        <li class="menu show-reply">답변 수 ({{count($item['subcomments'])}})</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="reply-form-place">
                                <form class="form reply-form" action="/comment/{{$board->id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="parent_comment_id" value="{{$item['id']}}">
                                    <textarea placeholder="Reply" 
                                    name="content"></textarea>
                                    <button type="submit" class="submit">등록하기</button>
                                </form>
                            </div>
                        </div>
                        @if(count($item['subcomments']) > 0)
                            @foreach($item['subcomments'] as $sub_key => $sub_item)
                            <div class="replies">
                                <div class="reply">
                                <div class="content">
                                    <header class="top">
                                    <div class="username">{{$sub_item['user']['name']}}</div>
                                    <div class="utility">
                                            @if(Auth::check())
                                                @if(Auth::id() == $sub_item['user']['id'])
                                                    <button class="btn btn-primary text-white" href="#" id="changeComment">수정</button>
                                                    <form method="post" action="{{route('comment.destroy',['comment'=>$sub_item['id']])}}">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="submit" class="btn btn-danger" value="삭제">
                                                    </form>
                                                @endif
                                            @endif
                                    </div>
                                    </header>
                                    <div class="reply-content"><p>{{$sub_item['content']}}</p></div>
                                    <div class="reply-content-update-form">
                                        <form action="/comment/update/{{$sub_item['id']}}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="text" value="{{$sub_item['content']}}" name='content'>
                                            <input type="submit" class="btn btn-success" value="수정">
                                            <button type='button' id="changeCancel" class="btn btn-danger">취소</button>
                                        </form>
                                    </div>
                                    <ul class="bottom">
                                    <li class="menu time">{{$sub_item['created_at']}}</li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    @endforeach --}}
                </div>
            </div>
        </div>
    </div>
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