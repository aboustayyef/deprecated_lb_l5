@extends('admin.layout')

@section('title')
List of Blogs
@stop

@section('content')

<h1>List of Blogs</h1>
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
		@foreach($blogs as $blog)
			<td>{{$blog->shorthand}}</td>
			<td>{{$blog->name}}</td>
			<td><a href="{{route('admin.blogs.edit', ['blogs' => $blog->id])}}"></a></td>
		@endforeach
	</tbody>
</table>

<a href="{{route('admin.blogs.create')}}" class="btn btn-primary">Add New Blog</a>

@stop