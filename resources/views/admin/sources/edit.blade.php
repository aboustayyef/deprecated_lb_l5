@extends('admin.layout')

@section('title')
Edit Source
@stop

@section('content')
<h1>Edit Source</h1><hr>


{!! Form::model($source, ['route' => ['admin.sources.update', $source->id], 'method' => 'PUT', 'files'=>true]) !!}
	@include('admin.sources.form')

{!! Form::submit("Submit", ['class' => 'btn btn-primary pull-right']) !!}

{!! Form::close() !!}

@stop