@extends('app')

@section('content')
<div class="row">
	<div class="col-md-offset-3 col-md-6">
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

		{!! Form::open(array('route' => 'pages.contact', 'id' => 'contact-form')) !!}
			<div class="form-group">
				<input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required>
			</div>
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ old('email') }}" required>
			</div>
			<div class="form-group">
				<textarea class="form-control" name="message" rows="6" placeholder="Your Message..." required>{{ old('message') }}</textarea>
			</div>

			<button class="btn pull-right" type="submit">Send Message</button>
		{!! Form::close() !!}
	</div>
</div>
@endsection