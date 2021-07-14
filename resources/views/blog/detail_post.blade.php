@extends('layouts.home_layouts', ['title' => $post->title, 'image' => $post->thumb])
@section('container')
<header class="masthead" style="background-image: url({{ asset('assets/blog/img/wave-dark.svg') }})">
	<div class="container position-relative px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<div class="post-heading">
					<h1>{{$post->title}}</h1>
					<span class="meta">
						Posted by
						<a href="#!">{{$post->user->name}}</a>
						on
						{{$post->created_at->format('F d, Y')}}
					</span>
					<span class="meta fs-6 mt-2">
						<i class="fa fa-eye"></i> {{$post->views}}
					</span>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- Post Content-->
<article class="mb-4">
	<div class="container px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				{!!$post->body!!}
				<p>
					@isset ($post->category)
					Category: <a class="text-decoration-none" href="{{ url('/categories/'.$post->category->slug) }}">{{$post->category->name}}</a>
					<br>
					@endisset
					Tags:
					@forelse ($post->tags as $tag)
					<a class="text-decoration-none" href="{{ url('/tags/'.$tag->slug) }}" class="px-2">#{{$tag->name}}</a>
					@empty
					@endforelse
				</p>
			</div>
		</div>
	</div>
</article>
@endsection