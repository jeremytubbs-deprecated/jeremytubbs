<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">{{ env('SITE_NAME') }}</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				@if(Auth::user() && Auth::user()->hasGroup('admin'))
					<li><a href="/posts/create">New Post</a></li>
				@else
					<li><a href="/contact">Contact</a></li>
				@endif
				@if (Auth::guest())
					<li><a href="/login">Login</a></li>
					<li><a href="/register">Register</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							@if(Auth::user()->hasGroup('admin'))
							<li><a href="/admin">Dashboard</a></li>
							@endif
							<li><a href="/logout">Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>