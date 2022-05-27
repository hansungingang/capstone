@extends('layouts.app')

@section('style')
    <link type="text/css" rel="stylesheet" href="{{asset('css/register/register-index.css')}}">
@stop

@section('script')
    <script type="text/javascript" src="{{asset('js/register/register-index.js')}}" charset="utf-8"></script>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('회원가입') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <fieldset class="area_agreement">
                            <legend>이용약관 / 개인정보 수집 및 이용 동의</legend>
                            <div class="mb-2 row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkBox-agree-all">
                                        <label class="form-check-label" id="checkBox-agree-all-label" for="checkBox-agree-all">약관 모두 동의하기</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" id="checkBox-agree-age" class="form-check-input" name="age">
                                        <label class="form-check-label" for="checkBox-agree-age">만 14세 이상입니다. <strong>(필수)</strong></label>
                                        @error('age')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkBox-agree-service" name="service">
                                        <label class="form-check-label" for="checkBox-agree-service">서비스 이용 약관 <strong>(필수)</strong></label>
                                        @error('service')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkBox-agree-privacy" name="privacy">
                                        <label class="form-check-label" for="checkBox-agree-privacy">개인정보 수집 및 이용 <strong>(필수)</strong></label>
                                        @error('privacy')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkBox-agree-mailing" name="useMailing">
                                        <label class="form-check-label" for="checkBox-agree-mailing">이벤트 이메일 수신 <span>(선택)</span></label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="area_require">
                            <legend>필수 정보</legend>
                            <div class="mb-2 row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('닉네임') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('이메일') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('비밀번호') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('비밀번호 확인') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="area_interest">
                            <legend>관심 정보</legend>
                            <div class="mb-3 row">
                                <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('관심 카테고리') }}</label>
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
                                                    <li><input type="checkbox" id="sub_category_checkbox{{$subCategoryItem['category']['code_name'].$subCategoryItem['id']}}" name="sub_category[]" value="{{$subCategoryItem['category']['code_name'].$subCategoryItem['id']}}">
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
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('가입하기') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
