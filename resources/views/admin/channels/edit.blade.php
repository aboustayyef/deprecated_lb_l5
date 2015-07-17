@extends('admin.layout')

@section('title')
Edit Channel [$channel->shorthand]
@stop

@section('content')
<h1>Edit Channel [{{$channel->shorthand}}]</h1>
<hr>

{!! Form::model($channel, ['route' => ['admin.channels.update', $channel->id], 'method' => 'PUT']) !!}

<?php $message = "Submit edit" ?>

@include('admin.channels.form')

{!! Form::close() !!}

@stop