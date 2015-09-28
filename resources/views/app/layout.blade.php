<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
</head>
<body>
	@include('app.partials.headerScript')
	@yield('content')
</body>
</html>