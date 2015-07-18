@extends('admin.layout')

@section('title')
Create New Channel
@stop

@section('content')
<h1>Create New Channel</h1>
<hr>

{!! Form::open(['method' => 'POST', 'route' => 'admin.channels.store', 'class' => 'form-horizontal']) !!}

<?php $message = "Create" ?>
@include('admin.channels.form')

{!! Form::close() !!}

@stop