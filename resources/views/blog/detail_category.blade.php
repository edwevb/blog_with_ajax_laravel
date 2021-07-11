@extends('layouts.home_layouts', ['title' => $category->name])
@section('container')
<div class="page-header">
	<div class="page-header-bg" style="background-image: url('./img/header-2.jpg');" data-stellar-background-ratio="0.5"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 text-center">
				<h1 class="text-uppercase"><span class="text-blog">{{$category->name}}</span></h1>
			</div>
		</div>
	</div>
</div>
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-8">
				<h3 class="toUpperCase"><span class="text-blog">DAFTAR</span>  Artikel</h3>
				@forelse ($posts as $post)
				<!-- post -->
				<div class="post post-row">
					<a class="post-img" href="blog-post.html"><img src="{{ asset('assets/local/img/'.$post->thumb) }}" alt=""></a>
					<div class="post-body">
						<h3 class="post-title"><a href="{{ url('/posts/'.$post->slug) }}">{{$post->title}}</a></h3>
						<ul class="post-meta">
							<li><a href="{{ url('/author/'.$post->user_id) }}">{{$post->user->name}}</a></li>
							<li>{{$post->created_at->format('F, Y')}}</li>
						</ul>
						<p>{!! \Str::limit($post->body, 150)!!}</p>
						<div class="tags-widget">
							<ul>
								@forelse ($post->tags as $tag)
								<li><a class="small" href="{{ url('/tags/'.$tag->slug) }}">{{$tag->name}}</a></li>
								@empty
								@endforelse
							</ul>
						</div>
						<div class="text-xs">
							<i class="fas fa-eye"></i> {{$post->views}}
						</div>
					</div>
				</div>
				<!-- /post -->
				@empty
				@endforelse
				<div class="text-center">
					{!! $posts->render() !!}
				</div>
			</div>

			<div class="col-md-4">
				<!-- post widget -->
				<div class="aside-widget">
					<div class="section-title">
						<h2 class="title"><span class="text-blog">artikel</span>  Populer</h2>
					</div>
					<!-- post -->
					@forelse ($post->mostViewed as $popular)
					{{-- expr --}}
					<div class="post post-widget">
						<a class="post-img" href="{{ url('/posts/'.$popular->slug) }}"><img src="{{ asset('assets/local/img/'.$popular->thumb) }}"></a>
						<div class="post-body">
							<div class="post-category">
								@isset ($popular->category)
								<a href="{{ url('/categories/'.$popular->category->slug) }}">{{$popular->category->name}}</a>
								@endisset
							</div>
							<h3 class="post-title"><a href="{{ url('/posts/'.$popular->slug) }}">{{$popular->title}}</a></h3>
							<ul class="post-meta">
								<li><a href="{{ url('/author/'.$popular->user_id) }}">{{$popular->user->name}}</a></li>
								<li>{{$popular->created_at->format('F, Y')}}</li>
							</ul>
							<span class="text-xs"><i class="fas fa-eye"></i> {{$popular->views}}</span>
						</div>
					</div>
					@empty
					@endforelse
					<!-- /post -->
				</div>
				<!-- /post widget -->
				<!-- category widget -->
				<div class="aside-widget">
					<div class="section-title">
						<h2 class="title"><span class="text-blog">DAFTAR</span> Kategori ({{$category->listCategory->count()}})</h2>
					</div>
					<div class="category-widget">
						<ul>
							@forelse ($category->listCategory as $category)
							<li><a href="{{ url('/categories/'.$category->slug) }}">{{$category->name}} <span>{{$category->posts->count()}}</span></a></li>
							@empty
							@endforelse
						</ul>
					</div>
				</div>
				<!-- /category widget -->
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->


@endsection