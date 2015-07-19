<div class="form-group">
	<div class="col-sm-3">
		<strong>Thumb:</strong>
	</div>
@if(isset($blog))
	@if(isset($blog->shorthand))
		@if(file_exists(public_path().'/img/thumbs/' . $blog->shorthand . '.jpg'))
					<div class="col-sm-1">
						<img src="{{asset('/img/thumbs/' . $blog->shorthand . '.jpg')}}" style="max-width:100%; height:auto">
					</div>				
					<div class="col-sm-8">
						{!! Form::file('thumb') !!}
						<p class="help-block">To replace the blog's thumbnail image, upload a new file</p>
						<small class="text-danger">{{ $errors->first('thumb') }}</small>
					</div>	
				</div>
			<?php return; ?>
		@endif
	@endif
@endif

{{-- Else, when no thumb --}}

<div class="col-sm-9">
	{!! Form::file('thumb') !!}
	<p class="help-block">To add a thumbnail image to the blog, upload a new file</p>
	<small class="text-danger">{{ $errors->first('thumb') }}</small>

</div>	

</div>