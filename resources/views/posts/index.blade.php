@extends('app')

@section('content')
	@foreach($posts as $post)
		{!! link_to_action('PostsController@show', $post->title, $post->slug) !!}
		{!! link_to_action('PostsController@edit', 'Edit', $post->id) !!}<br>
	@endforeach
@endsection