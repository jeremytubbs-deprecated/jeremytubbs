@extends('app')

@section('content')
<div class="uk-container uk-container-center">
	@include('projects.partials.upload')

	{!! Form::open(['route' => ['admin.projects.store'], 'method' => 'POST', 'role' => 'form', 'class' => 'uk-form uk-width-medium-1-1']) !!}

		@include('projects.partials.form')

	{!! Form::close() !!}
</div>
@endsection

@section('styles')
	<link href="/css/admin.css" rel="stylesheet">
@endsection