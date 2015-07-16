@extends('admin.layout')

@section('title')
Create New Channel
@stop

@section('content')
<h1>Create New Channel</h1>
<hr>

{!! Form::model(['method' => 'POST', 'route' => 'admin.channels.store', 'class' => 'form-horizontal']) !!}

    <div class="form-group">
        {!! Form::label('shorthand', 'Shorthand reference', ['class' => 'col-sm-3 control-label']) !!}
    	<div class="col-sm-9">
        	{!! Form::text('shorthand', null, ['class' => 'form-control', 'required' => 'required']) !!}
        	<small class="text-danger">{{ $errors->first('shorthand') }}</small>
    	</div>
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description: (optional)', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
        	{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        	<small class="text-danger">{{ $errors->first('description') }}</small>
    	</div>
    </div>

	<div class="form-group">
	    {!! Form::label('parent', 'Parent Channel (optional)', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	{!! Form::select('parent', $options, $selected, ['class' => 'form-control']) !!}
	    	<small class="text-danger">{{ $errors->first('parent') }}</small>
		</div>
	</div>

    <div class="btn-group pull-right">
        {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
        {!! Form::submit("Add", ['class' => 'btn btn-success']) !!}
    </div>

{!! Form::close() !!}

@stop