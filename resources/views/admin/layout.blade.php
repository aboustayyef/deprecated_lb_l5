<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">
	<title>@yield('title')</title>
</head>
<body>
	<div class="container">
		@if(\Session::has('message'))
			<h3>{{\Session::get('message')}}</h3>
		@endif
		@yield('content')
	</div>
	<script type="text/javascript" src="{{asset('js/vendor.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
</body>
</html>