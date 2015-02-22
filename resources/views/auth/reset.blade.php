@extends('app')

@section('content')

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<h1>Reset Password</h1>

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

		<form class="form-horizontal" role="form" method="POST" action="/password/reset">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="token" value="{{ $token }}">

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
					Reset Password
				</button>
			</div>
		</form>
	</div>
</div>
@endsection
