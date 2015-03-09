@extends('app')

@section('content')
<div class="uk-container uk-container-center">
	<div class="uk-grid">
		<div class="uk-width-medium-3-4">
		<article>
			<h1 class="uk-article-title">{{ $post->title }}</h1>
			<p>
				{!! $post->html !!}
			</p>
		</article>
		</div>
	</div>
</div>
@endsection