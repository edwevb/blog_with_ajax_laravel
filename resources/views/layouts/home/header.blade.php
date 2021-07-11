
<header id="header">
	<!-- NAV -->
	<div id="nav">
		<!-- Top Nav -->
		<div id="nav-top">
			<div class="container">
				<!-- social -->
				<ul class="nav-social">
					<li><a href="#footer" class="primary-button">Get in touch!</a></li>
				</ul>
				<!-- /social -->

				<!-- logo -->
				<div class="nav-logo">
					<h1><a href="{{ url('/') }}" class="logo">Edward <span class="text-blog">Blog</span></a></h1>
				</div>
				<!-- /logo -->

				<!-- search & aside toggle -->
				<div class="nav-btns">
					<button class="aside-btn"><i class="fa fa-bars"></i></button>
					<button class="search-btn"><i class="fa fa-search"></i></button>
					<div id="nav-search">
						<form>
							<input class="input" name="search" placeholder="Enter keywords...">
							<button type="submit" class="primary-button" style="margin-top: 2rem">Search</button>
						</form>
						<button class="nav-close search-close">
							<span></span>
						</button>
					</div>
				</div>
				<!-- /search & aside toggle -->
			</div>
		</div>
		<!-- /Top Nav -->

		<!-- Aside Nav -->
		<div id="nav-aside">
			<ul class="nav-aside-menu">
				<li><a href="index.html">Home</a></li>
				<li class="has-dropdown"><a>Categories</a>
					<ul class="dropdown">
						<li><a href="#">Lifestyle</a></li>
						<li><a href="#">Fashion</a></li>
						<li><a href="#">Technology</a></li>
						<li><a href="#">Travel</a></li>
						<li><a href="#">Health</a></li>
					</ul>
				</li>
				<li><a href="about.html">About Us</a></li>
				<li><a href="contact.html">Contacts</a></li>
				@auth
				<li class="has-dropdown"><a>{{auth()->user()->email}}</a>
					<ul class="dropdown">
						<li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
						<li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</li>
					</ul>
				</li>
				@else
				<li><a href="{{ url('/login') }}">Login</a></li>
				@endauth
			</ul>
			<button class="nav-close nav-aside-close"><span></span></button>
		</div>
		<!-- /Aside Nav -->
	</div>
	<!-- /NAV -->
</header>
<!-- /HEADER -->