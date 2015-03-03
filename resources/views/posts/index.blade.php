@extends('app')

@section('content')
	@foreach($posts as $post)
		{!! Form::open(['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) !!}
			{!! link_to_action('PostsController@show', $post->title, $post->slug) !!}
			{!! link_to_action('PostsController@edit', 'Edit', $post->id) !!}
    		<button type="submit" class="btn btn-link">Delete</button>
		{!! Form::close() !!}
	@endforeach
@endsection