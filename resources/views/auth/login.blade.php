@extends('app')

@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<h1>Login.</h1>
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

		<form class="form" role="form" method="POST" action="/login">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<!-- Email Form Input -->
            <div class="form-group">
            	<label>Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ old('email') }}" required>
            </div>

            <!-- Password Form Input -->
            <div class="form-group">
            	<label>Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="form-group">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="remember"> Remember Me
					</label>
				</div>
			</div>

            <!-- Sign In Input -->
            <div class="form-group">
                <button type="submit" class="btn btn-block">
					Login
				</button>
            </div>
		</form>
		<div class="form-group">
			<button class="btn btn-block btn-link btn-sm">
				<a href="/register">Need an Account? Register Here.</a>
			</button>
			<button type="submit" class="btn btn-block btn-link btn-sm">
				<a href="/password/forgot">Forgot your password?</a>
			</button>
		</div>
</div>

	</div>
</div>

@endsection
