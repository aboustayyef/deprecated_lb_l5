@extends('admin.layout')

@section('title')
Channels
@stop

@section('content')

<h2>Channels</h2>

<table class="table table-striped">
	<thead>
		<tr>
			<td>Shorthand</td>
			<td>Description</td>
			<td>Parent</td>
			<td>tools</td>
		</tr>
	</thead>
	
	<tbody>
		@foreach(App\Channel::all() as $channel)
			<tr>
				<td>{{$channel->shorthand}}</td>
				<td>{{$channel->description}}</td>
				<td>
					@if($channel->parent)
						{{$channel->parent->shorthand}}
					@else
						Top Level
					@endif
				</td>
				<td><a href="{{route('admin.channels.edit', ['channels' => $channel->id])}}">[edit]</a></td>
			</tr>
		@endforeach	
	</tbody>
	

</table>

@stop