@extends('app')

@section('content')
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<h1>Contact.</h1>
		</div>
	</div>

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

	{!! Form::open(array('route' => 'pages.contact', 'id' => 'contact-form')) !!}
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<div class="form-group">
				<input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ Input::old('name') }}" required>
			</div>
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ Input::old('email') }}" required>
			</div>
			<div class="form-group">
				<textarea class="form-control" name="message" rows="4" placeholder="Your Message..." required>{{ Input::old('message') }}</textarea>
			</div>

			<button class="btn btn-default pull-right" type="submit">Send Message</button>
		</div>
	</div>
	{!! Form::close() !!}
@stop