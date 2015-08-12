@extends('admin.layout')

@section('title')
Edit Channel [$channel->shorthand]
@stop

@section('content')

@include('admin.channels.modal_delete_form')

<h1>Edit Channel [{{$channel->shorthand}}]</h1>
<hr>

{!! Form::model($channel, ['route' => ['admin.channels.update', $channel->id], 'method' => 'PUT']) !!}

<?php $message = "Submit" ?>

@include('admin.channels.form')

<button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target=".modal">
  delete
</button>


{!! Form::close() !!}

@stop