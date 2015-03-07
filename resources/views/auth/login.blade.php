@extends('app')

@section('content')
<div class="uk-grid">
	<div class="uk-container-center">
		<h1>Login.</h1>
		@if (count($errors) > 0)
			<div class="uk-alert uk-alert-danger" data-uk-alert>
				<a href="" class="uk-alert-close uk-close"></a>
				<p>
					<strong>Whoops!</strong> There were some problems with your input.<br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</p>
			</div>
		@endif

		<form role="form" method="POST" action="/login" class="uk-form uk-form-stacked">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="uk-form-row">
				<label class="uk-form-label">Email Address</label>
				<div class="uk-form-controls">
					<input type="email" name="email" class="uk-form-width-medium" placeholder="email@example.com" value="{{ old('email') }}" required>
				</div>
			</div>

			<div class="uk-form-row">
				<label class="uk-form-label">Password</label>
				<div class="uk-form-controls">
					<input type="password" class="uk-form-width-medium" name="password">
				</div>
			</div>

			<div class="uk-form-row">
				<div class="uk-form-controls">
					<input type="checkbox" name="remember">
					<label> Remember Me</label>
				</div>
			</div>

			<div class="uk-form-row">
				<button type="submit" class="uk-button uk-width-1-1">Login</button>
			</div>

			<div class="uk-form-row">
				<a class="uk-button uk-button-link uk-width-1-1 uk-button-mini" href="/register">
					Need an Account? Register Here.
				</a>
			</div>

			<div class="uk-form-row">
				<a class="uk-button uk-button-link uk-width-1-1 uk-button-mini" href="/password/forgot">
					Forgot your password?
				</a>
			</div>
		</form>

	</div>
</div>

@endsection
