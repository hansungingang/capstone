@extends('layouts.app')

@section('style')
  <link type="text/css" rel="stylesheet" href="{{asset('css/myinfo/myinfo-index.css')}}">
@stop

@section('script')
  <script type="text/javascript" src="{{asset('js/myinfo/myinfo-index.js')}}" charset="utf-8"></script>
@stop

@section('content')
<form method="post" action="{{route('myinfo.update')}}">
@method('put')
@csrf
  <fieldset class="area_interest">
    <legend>관심 정보</legend>
    <div class="row mb-3">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('관심 카테고리') }}</label>
        <div class="col-md-6">
            <button type="button" class="btn btn-secondary" id="interest_category_button">관심 카테고리 선택</button>
            <div class="interest_wrap">
                <div class="d-flex justify-content-start">
                    <ul class="category">
                        @foreach ($category as $key => $item)
                            <li value="{{$item['code_name']}}" {{$key == key($category) ? "class=selected" : ""}}>{{$item['name']}}</li>
                        @endforeach
                    </ul>
                    @foreach ($sub_category as $key => $item)
                        @foreach ($item as $subCategoryKey => $subCategoryItem)
                            @if($subCategoryKey == 0)
                                <ul class="sub_category {{$key == 1 ? 'on' : ''}}" data-value="{{$subCategoryItem['category']['code_name']}}">
                            @endif
                            <li><input type="checkbox" id="sub_category_checkbox{{$subCategoryItem['category']['code_name'].$subCategoryItem['id']}}" name="sub_category[]" value="{{$subCategoryItem['category']['code_name'].$subCategoryItem['id']}}" {{ in_array($subCategoryItem['category']['code_name'].$subCategoryItem['id'],$my_info_sub_category) ? 'checked' : '' }}>
                                <label for="sub_category_checkbox{{$subCategoryItem['category']['code_name'].$subCategoryItem['id']}}">
                                    {{$subCategoryItem['name']}}
                                </label>
                            </li>
                            @if($subCategoryKey == count($item) -1)
                                </ul>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                <div class="check_category_area">
                    <span class="no_checked" style="display: block;">선택한 항목이 없습니다.</span>
                </div>
            </div>
        </div>
    </div>
  </fieldset>
  <div class="row mb-3">
    <div class="col-md-10">
        <div class="float-end">
            <button type="submit" class="btn btn-primary">
                {{ __('카테고리 변경하기') }}
            </button>
        </div>
    </div>
</div>
</form>
@stop
