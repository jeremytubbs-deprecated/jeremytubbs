@extends('app')

@section('content')
<div class="uk-container uk-container-center">
	@include('posts.partials.upload')

	{!! Form::open(['route' => ['admin.posts.store'], 'method' => 'POST', 'role' => 'form', 'class' => 'uk-form uk-width-medium-1-1']) !!}

		@include('posts.partials.form')

	{!! Form::close() !!}
</div>
@endsection

@section('styles')
	<link href="/css/admin.css" rel="stylesheet">
@endsection
