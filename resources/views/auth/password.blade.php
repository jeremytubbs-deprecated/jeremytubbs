@extends('app')

@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
	<h1>Reset Password.</h1>
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif

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

		<form class="form" role="form" method="POST" action="/password/forgot">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group">
				<label>E-Mail Address</label>
				<input type="email" class="form-control" name="email" value="{{ old('email') }}">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-block">
					Send Password Reset Link
				</button>
			</div>
		</form>
	</div>
</div>
@endsection
