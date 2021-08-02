@extends('layouts.home_layouts',  ['title' => 'Preview'])
@push('editor_styles')
<link href="{{ asset('assets/vendor/prism/prism.css') }}" rel="stylesheet">
@endpush
@section('container')
<!-- Page Header-->
<header class="masthead" style="background-image: url({{ asset('assets/blog/img/wave-white.svg') }})">
	<div class="container position-relative px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<div class="post-heading">
					<h1>Deret Fibonacci dengan PHP</h1>
					<span class="meta">
						Posted by
						<a href="#!">Start Bootstrap</a>
						on August 24, 2021
					</span>
				</div>
			</div>
		</div>
	</div>
</header>
<article class="mb-4">
	<div class="container px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<div class="row">
					<div class="col bg-warning m-2">Pulsa</div>
					<div class="col bg-warning m-2">Paket</div>
					<div class="col bg-light expandShow m-2" style="visibility: hidden;">Transfer</div>
					<div class="col bg-light expandShow m-2" style="visibility: hidden;">Cashout</div>
				</div>
				<button id="expandMenu" class="btn btn-sm btn-outline-dark">Show more </button>
			</div>
		</div>
	</div>
</article>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5eef7ac28f548f31"></script>
<script>
	$(document).ready(function(){
		let expandShow = $('.expandShow');
		let expandMenu = $('#expandMenu');
		expandMenu.on('click', function(e){
			if (expandShow.css('visibility') == 'hidden' ) {
				expandShow.css('visibility','visible');
				expandMenu.text('Show less');
			}else{
				expandShow.css('visibility','hidden');
				expandMenu.text('Show more');
			}
			e.preventDefault();
		});
	});

	$(document).ready(function(){
		$(".btn-share").click(function(){
			$("#socialShare").slideToggle();
		});
	});
</script>
@push('editor_scripts')
<script src="{{ asset('assets/vendor/prism/prism.min.js') }}"></script>
@endpush