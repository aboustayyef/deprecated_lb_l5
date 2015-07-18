@extends('admin.layout')

@section('title')
Channels
@stop

@section('content')

<h2>Channels</h2>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Shorthand</th>
			<th>Description</th>
			<th>color</th>
			<th>Parent</th>
			<th>tools</th>
		</tr>
	</thead>
	
	<tbody>
		@foreach(App\Channel::all() as $channel)
			<tr>
				<td>{{$channel->shorthand}}</td>
				<td>{{$channel->description}}</td>
				<td>{{$channel->color}}</td>
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
	<a href="{{route('admin.channels.create')}}" class="btn btn-primary">Add New Channel</a>

@stop