<!DOCTYPE html>
<html lang="ko">
	<head>
    		<meta charset="UTF-8">
    		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    		@yield('metatag') <!-- 헤드 부분. -->
    		<title>@yield('title')</title> <!-- 타이틀 제목 -->
    		@yield('style') <!-- 스타일 컨텐츠가 들어갈 부분 -->
	</head>
	<body>
		@yield('content') <!-- body 컨텐츠가 들어갈 부분 -->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		@yield('script') <!-- script가 들어갈 부분 -->
	</body>
</html>