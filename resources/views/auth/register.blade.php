@extends('app')

@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<h1>Register.</h1>
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

		<form class="form" role="form" method="POST" action="/register">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" value="{{ old('name') }}">
			</div>

			<div class="form-group">
				<label>E-Mail Address</label>
				<input type="email" class="form-control" name="email" value="{{ old('email') }}">
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password">
			</div>

			<div class="form-group">
				<label>Confirm Password</label>
				<input type="password" class="form-control" name="password_confirmation">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-block">
					Register
				</button>
			</div>
		</form>
	</div>
</div>
@endsection
