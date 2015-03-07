@extends('app')

@section('content')
<div class="uk-grid">
	<div class="uk-container-center">
	<h1>Reset Password.</h1>
		@if (session('status'))
			<div class="uk-alert uk-alert-success">
				{{ session('status') }}
			</div>
		@endif

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

		<form class="uk-form uk-form-stacked" role="form" method="POST" action="/password/forgot">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="uk-form-row">
				<label class="uk-form-label">E-Mail Address</label>
				<input type="email" class="uk-width-1-1" name="email" value="{{ old('email') }}">
			</div>

			<div class="uk-form-row">
				<button type="submit" class="uk-button uk-width-1-1">
					Send Password Reset Link
				</button>
			</div>
		</form>
	</div>
</div>
@endsection
