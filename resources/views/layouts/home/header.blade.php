<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
	<div class="container px-4 px-lg-5">
		<a class="navbar-brand" href="{{ url('/') }}">Edward Blog</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			Menu
			<i class="fas fa-bars"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ms-auto py-4 py-lg-0">
				<li class="nav-item">
					<a class="nav-link px-lg-3 py-3 py-lg-4 {{request()->is('/') ? 'active':''}}" href="{{ url('/') }}">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link px-lg-3 py-3 py-lg-4 {{request()->is('list-categories') ? 'active':''}}" href="{{ url('/list-categories') }}">Category</a>
				</li>
				<li class="nav-item">
					<a class="nav-link px-lg-3 py-3 py-lg-4 {{request()->is('list-tags') ? 'active':''}}" href="{{ url('/list-tags') }}">Tag</a>
				</li>
				<li class="nav-item">
					<a class="nav-link px-lg-3 py-3 py-lg-4 {{request()->is('about') ? 'active':''}}" href="{{ url('/about') }}">About</a>
				</li>
				@auth()
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle px-lg-3 py-3 py-lg-4" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Settings
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
						<li>
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</li>
					</ul>
				</li>
				@endauth
			</ul>
		</div>
	</div>
</nav>