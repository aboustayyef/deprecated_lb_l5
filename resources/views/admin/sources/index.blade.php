@extends('admin.layout')

@section('title')
List of Sources
@stop

@section('content')

<h1>List of Sources</h1>
<hr>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Shorthand</th>
			<th>Name</th>
			<th>Tools</th>
		</tr>
	</thead>
	<tbody>
		@foreach($sources->all() as $source)
		<tr>
			<td>{{$source->shorthand}}</td>
			<td>{{$source->name}}</td>
			<td> <a href="{{route('admin.sources.show', ['sources' => $source->id])}}">[details]</a> <a href="{{route('admin.sources.edit', ['sources' => $source->id])}}">[edit]</a></td>
		</tr>
		@endforeach
	</tbody>
</table>

<a href="{{route('admin.sources.create')}}" class="btn btn-primary">Add New Source</a>

@stop