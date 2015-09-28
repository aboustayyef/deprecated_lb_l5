@extends('app.layout')

@section('title')

@if (is_null($channel))
	Posts. Lebanese Blogs
@else
{{\App\Channel::where('shorthand', $channel)->first()->description}} Posts. Lebanese Blogs
@endif

@stop

@section('content')

<h1>TEST</h1>
{{var_dump($posts->toJson())}}
@stop