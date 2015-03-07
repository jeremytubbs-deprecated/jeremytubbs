@extends('app')

@section('content')
<div class="uk-grid">
	<div class="uk-container-center">
		<h1>Contact.</h1>

		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif

		{!! Form::open(array('route' => 'pages.contact', 'id' => 'contact-form', 'class' => 'uk-form')) !!}
			<div class="uk-form-row">
				<input type="text" name="name" class="uk-form-width-medium" placeholder="Your Name" value="{{ old('name') }}" required>
			</div>
			<div class="uk-form-row">
				<input type="email" name="email" class="uk-form-width-medium" placeholder="email@example.com" value="{{ old('email') }}" required>
			</div>
			<div class="uk-form-row">
				<textarea name="message" rows="6" class="uk-form-width-large" placeholder="Your Message..." required>{{ old('message') }}</textarea>
			</div>
			<div class="uk-form-row">
				<button class="uk-button uk-float-right" type="submit">Send Message</button>
			</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection