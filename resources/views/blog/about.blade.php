@extends('layouts.home_layouts', ['title' => 'About'])
@section('container')
<header class="masthead" style="background-image: url({{ asset('assets/blog/img/wave-dark.svg') }})">
	<div class="container position-relative px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<div class="page-heading">
					<h1>About Me</h1>
				</div>
			</div>
		</div>
	</div>
</header>
<main class="mb-4">
	<div class="container px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<div class="text-center">
					<div class="wrapper mt-5">
						<div class="circle"></div>
					</div>
					<p>Hello, I'm Edward. Glad to see you here!.</p>
				</div>
				<p>Saat membuat blog ini, saya adalah seorang mahasiswa tingkat akhir yang berkuliah di Universitas xxxxxxxxx - berlokasi di kota satelit yang ramai, dimana kendaraan hanya berjarak sejengkal tiap senja (sebelum pandemi ya hehe).</p>
				<a href="https://edwardevbert.netlify.app/" class="btn btn-outline-dark">GET IN TOUCH</a>
			</div>
		</div>
	</div>
</main>
@endsection