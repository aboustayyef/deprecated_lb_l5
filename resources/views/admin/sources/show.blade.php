@extends('admin.layout')

@section('title')
	Details For {{$source->name}}
@stop

@section('content')

<br><a href="{{route('admin.blogs.index')}}">&larr; Back to Blogs List</a><br>

<h1>Details For {{$source->name}}</h1><hr>

<h3>General Info:</h3>
<table class="table table-striped">
	<tr>
		<td class="col-md-2">Shorthand Identifier</td>
		<td>{{$source->shorthand}}</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>{{$source->name}}</td>
	</tr>
	<tr>
		<td>Description</td>
		<td>{{$source->description}}</td>
	</tr>
	<tr>
		<td>Blog Active:</td>
		<td>
			{{$source->active == 1 ? "Yes" : "No"}}
		</td>
	</tr>
</table>

<h3>URLs</h3>
<table class="table table-striped">
	<tr>
		<td class="col-md-2">Home Page</td>
		<td>{{$source->url}}</td>
	</tr>
	<tr>
		<td>RSS Feed</td>
		<td>{{$source->rss_feed ? $source->rss_feed : "<em>None</em>"}}</td>
	</tr>
</table>

<h3>Author Info</h3>
<table class="table table-striped">
	<tr>
		<td class="col-md-2">Author Name</td>
		<td>{{$source->author}}</td>
	</tr>
	<tr>
		<td>Author Twitter Address</td>
		<td>{{$source->author_twitter}}</td>
	</tr>
	<tr>
		<td>Author Email</td>
		<td>{{$source->author_email}}</td>
	</tr>
</table>

<a href="{{route('admin.blogs.edit', ['blogs'=>$source->id])}}" class="btn btn-warning">Edit</a>
@stop