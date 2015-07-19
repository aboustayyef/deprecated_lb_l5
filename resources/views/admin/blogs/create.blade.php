@extends('admin.layout')

@section('title')
Add New Blog
@stop

@section('content')
<h1>Add New Blog</h1>
<hr>

{!! Form::open(['method' => 'POST', 'route' => 'admin.blogs.store', 'class' => 'form-horizontal', 'files'=>true]) !!}

	@include('admin.blogs.form')

{!! Form::submit("Add", ['class' => 'btn btn-primary pull-right']) !!}

{!! Form::close() !!}


{{-- Ajax AutoFill form --}}
<form method="POST" action="{{route('ajax.info')}}">
	<input type="submit" id="autofill" disabled="disabled" class="btn btn-default" value="Autofill from Available data"></button>	
</form>

@stop