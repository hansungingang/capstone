<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckeditor/translations/ko.js') }}"></script>
    <script src="{{ asset('js/pageview/pageview.js') }}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1TGD3PRW40"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-1TGD3PRW40');
    </script>
    @yield('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    @yield('style')
</head>
<body>
    <input type="hidden" value="{{Request::fullUrl()}}" id="current">
    <input type="hidden" value="{{Request::server('HTTP_REFERER')}}" id="referer">
    <div class="wrapper">    
        <header>
            <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{route('basicImage',['name'=>'headerIcon.jpg'])}}" height="50" alt="ingangDamoa">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            
                        </ul>

                        
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <ul class="navbar-nav">
                                @if ( Auth::check() && Auth::user()->is_admin)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('lecture.create')}}">인강 등록</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{route('admin.index')}}">어드민 페이지</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('lecture.index')}}">인강 리스트 보기</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="/board">게시판</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="<?php echo route('survey.create')?>">설문 조사</a>
                                </li> --}}
                            </ul>


                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('로그인') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('회원가입') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                                        {{ Auth::user()->name }}
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{route('myinfo.index')}}">{{ __('내 정보 변경')}}</a></li>

                                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('로그아웃') }}
                                        </a></li>

                                        <li><form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form></li>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                강의 카테고리
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @foreach(\App\Models\Category::all() as $key => $value)
                                        <li><a class="dropdown-item" href="/lecture?category_id={{$value->id}}">{{$value->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form class="d-flex" action="/lecture">
                                <input class="form-control me-2" id="search" name="search" type="search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" id="modalButton" data-bs-target="#myModal">최근 본 목록</button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/interest">관심 목록</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col">
                        @yield('content')
                    </div>
                </div>    
            </div>
        </main>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <ul class="footer-nav">
                            <li><a href="/inquire">1:1 문의</a></li>
                            <li><a href="/notice">공지</a></li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="social-links">
                            <li><a href="#"><i class="fab fa-facebook">facebook</i></a></li>
                            <li><a href="#"><i class="fab fa-twitter">twitter</i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus">google</i></a></li>
                            <li><a href="#"><i class="fab fa-instagram">instagram</i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>This webpage has been created for educational purpose</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">최근 본 목록</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>