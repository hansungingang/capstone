@extends('layouts.app')

@section('style')
    <link type="text/css" rel="stylesheet" href="{{asset('css/welcome/welcome.css')}}">
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($ads as $item)
                @if (!empty($item['ad_mapping']) && $item['area_code']== 'AD001')
                    <h1>인기 상품</h1> 
                    <div class="box">
                        <div class="col-sm-6">
                            @foreach($item['ad_mapping'] as $key => $adItem)
                                @if($key %3 == 0)
                                    <ul>
                                @endif
                                <li>
                                    <a href="{{route('lecture.show',['lecture' => $adItem['lecture'][0]['id']])}}">
                                        <div class="card width18">
                                            <img class="card-img-top" src="{{route('basicImage',['name'=>$adItem['lecture'][0]['file']['name']])}}" width="300" height="200" >
                                            <div class="card-body">
                                                <p class="card-text">강의 이름 : {{$adItem['lecture'][0]['name']}}</p>
                                                <p class="card-text">강사 이름 : {{$adItem['lecture'][0]['instructor_name']}}</p>
                                                <p class="card-text">가격 : {{$adItem['lecture'][0]['platform'][0]['price']}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @if($key %3 == 2)
                                    </ul>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@stop