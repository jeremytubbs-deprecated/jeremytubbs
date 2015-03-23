<nav class="uk-navbar uk-navbar-attached uk-margin-bottom">
	<div class="uk-container uk-container-center">
		<a class="uk-navbar-brand" href="/">
			{{ env('SITE_NAME') }}
		</a>
		<div class="uk-navbar-flip">
			<ul class="uk-navbar-nav uk-hidden-small">
				@if(Auth::user())
					<li><a href="/contact">Contact</a></li>
				@endif
				@if (Auth::guest())
					<li><a href="/login">Login</a></li>
					<li><a href="/register">Register</a></li>
				@else
					<li class="uk-parent" data-uk-dropdown>
						<a href="#">{{ Auth::user()->name }} <i class="uk-icon-angle-down"></i></a>
						<div class="uk-dropdown uk-dropdown-navbar">
						<ul class="uk-nav uk-nav-navbar">
							@if(Auth::user()->hasGroup('admin'))
							<li><a href="/admin">Dashboard</a></li>
							<li><a href="/posts/create">New Post</a></li>
							<li><a href="/projects/create">Add Project</a></li>
							@endif
							<li><a href="/logout">Logout</a></li>
						</ul>
						</div>
					</li>
				@endif
			</ul>
			<a class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas="{target:'#my-id'}"></a>
		</div>
	</div>
</nav>

<div id="my-id" class="uk-offcanvas">
	<div class="uk-offcanvas-bar uk-offcanvas-bar-flip">
		<ul class="uk-nav uk-nav-offcanvas" data-uk-nav>
			@if(Auth::user() && Auth::user()->hasGroup('admin'))
				<li><a href="/posts/create">New Post</a></li>
			@else
				<li><a href="/contact">Contact</a></li>
			@endif
			@if (Auth::guest())
				<li><a href="/login">Login</a></li>
				<li><a href="/register">Register</a></li>
			@else
				@if(Auth::user()->hasGroup('admin'))
				<li><a href="/admin">Dashboard</a></li>
				@endif
				<li><a href="/logout">Logout</a></li>
			@endif
		</ul>
	</div>
</div>