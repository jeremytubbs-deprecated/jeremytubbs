@extends('app')

@section('content')
<div class="uk-grid">
	<div class="uk-container-center">
		<h1>Register.</h1>
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

		<form class="uk-form uk-form-stacked" role="form" method="POST" action="/register">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="uk-form-row">
				<label class="uk-form-label">Name</label>
				<input type="text" class="uk-form-width-medium" name="name" value="{{ old('name') }}">
			</div>

			<div class="uk-form-row">
				<label class="uk-form-label">E-Mail Address</label>
				<input type="email" class="uk-form-width-medium" name="email" value="{{ old('email') }}">
			</div>

			<div class="uk-form-row">
				<label class="uk-form-label">Password</label>
				<input type="password" class="uk-form-width-medium" name="password">
			</div>

			<div class="uk-form-row">
				<label class="uk-form-label">Confirm Password</label>
				<input type="password" class="uk-form-width-medium" name="password_confirmation">
			</div>

			<div class="uk-form-row">
				<button type="submit" class="uk-button uk-width-1-1">
					Register
				</button>
			</div>
		</form>
	</div>
</div>
@endsection
