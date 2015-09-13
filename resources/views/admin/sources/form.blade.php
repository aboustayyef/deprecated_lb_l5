<h3>General</h3>
	<hr>

	@include('admin.sources.thumb')

	{{-- Shorthand --}}
    <div class="form-group">
        {!! Form::label('shorthand', 'Shorthand, unique identifier', ['class' => 'col-sm-3 control-label']) !!}
    	<div class="col-sm-9">
        	{!! Form::text('shorthand', null, ['class' => 'form-control']) !!}
        	<small class="text-danger">{{ $errors->first('shorthand') }}</small>
    	</div>
    </div>

	{{-- Name --}}
	<div class="form-group">
	    {!! Form::label('name', 'Name:', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-9">
	    	{!! Form::text('name', null, ['class' => 'form-control']) !!}
	    	<small class="text-danger">{{ $errors->first('name') }}</small>
		</div>
	</div>

	{{-- Channel --}}
	<div class="form-group">
	    {!! Form::label('channel', 'Channel', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	@if(isset($source))
	    	<?php $test = $source->channels->lists('id')->all(); ?>
	    		{!! Form::select('channels[]',  \App\Channel::lists('shorthand', 'id'), $test, ['class' => 'form-control', 'required' => 'required', 'multiple']) !!}
	    	@else
	    		{!! Form::select('channels[]',  \App\Channel::lists('shorthand', 'id'), null, ['class' => 'form-control', 'required' => 'required', 'multiple']) !!}
	    	@endif
	    	<small class="text-danger">{{ $errors->first('channel') }}</small>
		</div>
	</div>

	{{-- Description --}}
	<div class="form-group">
	    {!! Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-9">
	    	{!! Form::text('description', null, ['class' => 'form-control']) !!}
	    	<small class="text-danger">{{ $errors->first('description') }}</small>
		</div>
	</div>

	{{-- Active --}}
	<div class="form-group">
	    {!! Form::label('active', 'Active?', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	{!! Form::select('active',[1=>'Yes', 0=>'No'], null, ['class' => 'form-control']) !!}
	    	<small class="text-danger">{{ $errors->first('active') }}</small>
		</div>
	</div>

	<h3>URLs</h3><hr>

	{{-- URL --}}
	<div class="form-group">
	    {!! Form::label('url', 'URL (Homepage)', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-9">
	    	{!! Form::text('url', null, ['class' => 'form-control']) !!}
	    	<small class="text-danger">{{ $errors->first('url') }}</small>
		</div>
	</div>

	{{-- RSS Feed --}}
	<div class="form-group">
	    {!! Form::label('rss_feed', 'RSS Feed (optional)', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-9">
	    	{!! Form::text('rss_feed', null, ['class' => 'form-control']) !!}
	    	<small class="text-danger">{{ $errors->first('rss_feed') }}</small>
		</div>
	</div>

	{{-- Media Parent --}}
	<div class="form-group">
	    {!! Form::label('media_parent', 'Media Parent (If No RSS)', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-9">
	    	{!! Form::text('media_parent', null, ['class' => 'form-control', 'placeholder'=>'OneWordOnly, Camel Case']) !!}
	    	<small class="text-danger">{{ $errors->first('media_parent') }}</small>
		</div>
	</div>

	<h3>Author Information</h3><hr>
	{{-- author --}}
	<div class="form-group">
	    {!! Form::label('author', 'Author Name', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-9">
	    	{!! Form::text('author', null, ['class' => 'form-control']) !!}
	    	<small class="text-danger">{{ $errors->first('author') }}</small>
		</div>
	</div>

	{{-- author twitter --}}
	<div class="form-group">
	    {!! Form::label('author_twitter', 'Author Twitter Account', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-9">
	    	{!! Form::text('author_twitter', null, ['class' => 'form-control', 'placeholder' => 'without the @']) !!}
	    	<small class="text-danger">{{ $errors->first('author_twitter') }}</small>
		</div>
	</div>

	{{-- author email --}}
	<div class="form-group">
	    {!! Form::label('author_email', 'Author email address', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-9">
	    	{!! Form::text('author_email', null, ['class' => 'form-control']) !!}
	    	<small class="text-danger">{{ $errors->first('author_email') }}</small>
		</div>
	</div>
