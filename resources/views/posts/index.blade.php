@extends('app')

@section('content')
<div class="uk-container uk-container-center">
	<div class="uk-grid">
		<div class="uk-width-medium-3-4">
		@foreach($posts as $post)
			<article class="uk-article">
				<h1 class="uk-article-title">{!! link_to_action('PostsController@show', $post->title, $post->slug) !!}</h1>
				<p>{{ $post->published }}</p>
				<p class="uk-article-meta">
					<span>Written by {{ $post->user->name }}</span>
					<br>
					<span><i class="uk-icon-tags"></i>
						@foreach($post->tags as $tag)
							#{{ $tag->name }}
						@endforeach
					</span>
				</p>
			</article>
		@endforeach
		</div>
	</div>
</div>
@endsection