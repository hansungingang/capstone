@if (!is_null($lecture['data']))
    @foreach ($lecture['data'] as $key => $item)
        @if($key % 2 == 0)
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <img alt="" src= "{{ route('imageDownload',$item['file']['id'] )}}" width="300" height="200" style="border: 1px solid">
                    <div class="lecture-info">
                        {{ $item['name'] }}
                        {{ $item['instructor_name']}}
                    </div>
                </div>
        @endif
        @if($key %2 == 1)
                <div class="col-sm-4">
                    <img alt="" src= "{{ route('imageDownload',$item['file']['id'] ) }}" width="300" height="200" style="border: 1px solid">
                    <div class="lecture-info">
                        {{ $item['name'] }}
                        {{ $item['instructor_name']}}
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    <br>
    <div class="d-flex justify-content-end">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <button type="button" id="pagination" class="btn" value="{{$lecture['prev_page_url']}}" {{ $lecture['prev_page_url'] ? '' : 'disabled'}}> Previous </button>
                </li>
                @if ($lecture['last_page'] > 1)
                    <ul class="pagination">
                        @for ($i = 1; $i <= $lecture['last_page']; $i++)
                        <li class="page-item {{ ($lecture['current_page'] == $i) ? ' active' : '' }}">
                            <button type="button" id="pagination" class="btn" value="{{ $lecture['links'][$i]['url']}}">{{ $lecture['links'][$i]['label']}}</button>
                        </li>
                        @endfor
                    </ul>
                @endif
                <li class="page-item">
                    <button type="button" id="pagination" class="btn" value="{{$lecture['next_page_url']}}" {{ $lecture['next_page_url'] ? '' : 'disabled'}}> Next </button>
                  </li>
              </ul>
        </nav>
    </div>
@else
    <div class="row">
        <div class="col"> 리스트가 존재하지 않습니다.</div>
    </div>
@endif