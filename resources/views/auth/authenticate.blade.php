@extends('admin.layout')

@section('title')
Login as Administrator
@stop

@section('content')
<h1>Log In Form:</h1>
<hr>
{!! Form::open(['method' => 'POST', 'class' => 'form-horizontal']) !!}

    <div class="form-group">
        {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
    	<div class="col-sm-9">
        	{!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        	<small class="text-danger">{{ $errors->first('email') }}</small>
    	</div>
    </div>

	<div class="form-group">
	    {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
	    <small class="text-danger">{{ $errors->first('password') }}</small>
		</div>
	</div>

	<div class="form-group">
	    <div class="col-sm-offset-3 col-sm-9">
	        <div class="checkbox">
	            <label for="remember">
	                {!! Form::checkbox('remember', null, null, ['id' => 'remember']) !!} Remember Me
	            </label>
	        </div>
	        <small class="text-danger">{{ $errors->first('remember') }}</small>
	    </div>
	</div>

    <div class="btn-group pull-right">
        {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
        {!! Form::submit("Submit", ['class' => 'btn btn-success']) !!}
    </div>


{!! Form::close() !!}

@stop