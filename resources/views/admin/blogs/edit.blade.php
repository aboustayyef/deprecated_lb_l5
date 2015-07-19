@extends('admin.layout')

@section('title')
Edit Blog
@stop

@section('content')
<h1>Edit Blog</h1><hr>


{!! Form::model($blog, ['route' => ['admin.blogs.update', $blog->id], 'method' => 'PUT', 'files'=>true]) !!}
	@include('admin.blogs.form')

{!! Form::submit("Submit", ['class' => 'btn btn-primary pull-right']) !!}

{!! Form::close() !!}

@stop