@if(!empty($lectures))
    @foreach($lectures as $key => $lecture_info)
        <div class="row">  
            <div class="col-sm-12"> 
                <a href="/lecture/show/{{ $lecture_info['id'] }}">
                <div class="card">
                    <img class="card-img-top" src="/file/imageDownload/{{$lecture_info['file']['id']}}" style="border: 0">
                    <div class="card-body">
                        <h5 class="card-title"> {{$lecture_info['name']}}</h5>
                        <p class="card-text"> 강사이름 :  {{ $lecture_info['instructor_name']}}</p>
                        @foreach( $lecture_info['platform'] as $key => $item)
                            <p class="card-text">플랫폼 : {{$item['platform_name']}} 가격: {{$item['price']}}</p>
                        @endforeach
                    </div> 
                </div> 
                </a> 
            </div>
        </div>
        <br>
    @endforeach
@else
    <div>최근 본 목록이 없습니다.</div>
@endif

