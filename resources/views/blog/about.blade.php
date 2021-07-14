@extends('layouts.home_layouts', ['title' => 'About'])
@section('container')
<header class="masthead" style="background-image: url({{ asset('assets/blog/img/wave-dark.svg') }})">
	<div class="container position-relative px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<div class="page-heading">
					<h1>About Me</h1>
					<span class="subheading">
						Hello! I'm Edward, it makes me happy to see you here.
					</span>
				</div>
			</div>
		</div>
	</div>
</header>
<main class="mb-4">
	<div class="container px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7 text-center">
				<p>Further information, please click button below</p>
				<a href="https://edwardevbert.netlify.app/" class="btn btn-outline-dark">GET IN TOUCH</a>
			</div>
		</div>
	</div>
</main>
@endsection