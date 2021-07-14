@extends('layouts.home_layouts', ['title' => 'List Tags'])
@section('container')
<header class="masthead" style="background-image:  url({{ asset('assets/blog/img/wave-dark.svg') }})">
	<div class="container position-relative px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<div class="post-heading">
					<h1>List Tags</h1>
				</div>
			</div>
		</div>
	</div>
</header>
<div class="container px-4 px-lg-5">
	<div class="row gx-4 gx-lg-5 justify-content-center">
		<div class="col-md-10 col-lg-8 col-xl-7 my-5">
			@foreach ($tags as $tag)
			<ul class="list-group">
				<li class="list-group-item d-flex justify-content-between align-items-center">
					<a href="{{ url('/tags/'.$tag->slug) }}">{{$tag->name}}</a>
					<span class="badge bg-primary rounded-pill">Posts: {{$tag->posts()->count()}}</span>
				</li>
			</ul>
			@endforeach
		</div>
	</div>
</div>
@endsection