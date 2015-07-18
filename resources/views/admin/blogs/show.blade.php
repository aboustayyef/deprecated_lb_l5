@extends('admin.layout')

@section('title')
	Details For {{$blog->name}}
@stop

@section('content')

<br><a href="{{route('admin.blogs.index')}}">&larr; Back to Blogs List</a><br>

<h1>Details For {{$blog->name}}</h1><hr>

<h3>General Info:</h3>
<table class="table table-striped">
	<tr>
		<td class="col-md-2">Shorthand Identifier</td>
		<td>{{$blog->shorthand}}</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>{{$blog->name}}</td>
	</tr>
	<tr>
		<td>Description</td>
		<td>{{$blog->description}}</td>
	</tr>
	<tr>
		<td>Blog Active:</td>
		<td>
			{{$blog->active == 1 ? "Yes" : "No"}}
		</td>
	</tr>
</table>

<h3>URLs</h3>
<table class="table table-striped">
	<tr>
		<td class="col-md-2">Home Page</td>
		<td>{{$blog->url}}</td>
	</tr>
	<tr>
		<td>RSS Feed</td>
		<td>{{$blog->rss_feed ? $blog->rss_feed : "<em>None</em>"}}</td>
	</tr>
</table>

<h3>Author Info</h3>
<table class="table table-striped">
	<tr>
		<td class="col-md-2">Author Name</td>
		<td>{{$blog->author}}</td>
	</tr>
	<tr>
		<td>Author Twitter Address</td>
		<td>{{$blog->author_twitter}}</td>
	</tr>
	<tr>
		<td>Author Email</td>
		<td>{{$blog->author_email}}</td>
	</tr>
</table>

<a href="{{route('admin.blogs.edit', ['blogs'=>$blog->id])}}" class="btn btn-warning">Edit</a>
@stop