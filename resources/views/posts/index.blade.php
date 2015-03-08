@extends('app')

@section('content')
<div class="uk-container uk-container-center">
	@foreach($posts as $post)
		{!! Form::open(['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) !!}
			{!! link_to_action('PostsController@show', $post->title, $post->slug) !!}
			{!! link_to_action('PostsController@edit', 'Edit', $post->id) !!}
    		<button type="submit" class="uk-button">Delete</button>
		{!! Form::close() !!}
	@endforeach
</div>
@endsection