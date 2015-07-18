<div class="form-group">
    {!! Form::label('shorthand', 'Shorthand reference', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-9">
    	{!! Form::text('shorthand', null, ['class' => 'form-control']) !!}
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
    {!! Form::label('color', 'Color: (optional, format: #AAAAAA) ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('color', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('color') }}</small>
    </div>
</div>

<div class="form-group">
    {!! Form::label('parent_id', 'Parent Channel (optional)', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	{!! Form::select('parent_id', $options, null, ['class' => 'form-control']) !!}
    	<small class="text-danger">{{ $errors->first('parent_id') }}</small>
	</div>
</div>

{!! Form::submit($message, ['class' => 'btn btn-primary pull-right']) !!}
