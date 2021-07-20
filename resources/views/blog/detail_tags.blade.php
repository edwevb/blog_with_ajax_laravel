@extends('layouts.home_layouts', ['title' => $tag->name])
@section('container')
<header class="masthead" style="background-image: url({{ asset('assets/blog/img/wave-dark.svg') }})">
	<div class="container position-relative px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<div class="page-heading">
					<h1>Tag: {{$tag->name}}</h1>
				</div>
			</div>
		</div>
	</div>
</header>

<div class="container px-4 px-lg-5">
	<div class="row gx-4 gx-lg-5 justify-content-center">
		<div class="col-md-10 col-lg-8 col-xl-7">
			<!-- Post preview-->
			@foreach ($tag->posts as $post)
			<!-- Post-->
			<div class="post-preview">
				<a href="{{ url('/posts/'.$post->slug) }}">
					<h5 class="post-title" id="post-head">{{$post->title}}</h5>
				</a>
				@isset ($post->category)
				<div class="post-subtitle">
					Category: <a href="{{ url('/categories/'.$post->category->slug) }}">{{$post->category->name}}</a>
				</div>
				@endisset
				<p class="post-meta">
					Posted by
					<a href="#!">Start Bootstrap</a>
					on September 24, 2021
				</p>
			</div>
			<!-- /Post-->
			<hr class="my-4" />
			@endforeach
			<div class="d-flex">
				<div class="mx-auto">
					{!! $tag->posts->links() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection