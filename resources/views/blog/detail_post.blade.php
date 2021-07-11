@extends('layouts.home_layouts', ['title' => $post->title, 'image' => $post->thumb])
@section('container')
<!-- PAGE HEADER -->
<div id="post-header" class="page-header">
	<div class="page-header-bg" style="background-image: url({{ url('/assets/local/img/'.$post->thumb) }});"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<div class="post-category">
					@isset ($post->category)
					<a href="{{ url('/categories/'.$post->category->slug) }}">{{$post->category->name}}</a>
					@endisset
				</div>
				<h1>{{$post->title}}</h1>
				<ul class="post-meta">
					<li><a href="{{ url('/author/'. $post->user_id) }}">{{$post->user->name}}</a></li>
					<li>{{$post->created_at->format('F, y')}}</li>
					<li><i class="fa fa-eye"></i> {{$post->views}}</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- /PAGE HEADER -->
</header>
<!-- /HEADER -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-8">
				<!-- post content -->
				<div class="section-row">
					{{$post->body}}
				</div>
				<!-- /post content -->

				<!-- post tags -->
				<div class="section-row">
					<div class="post-tags">
						<ul>
							<li>TAGS:</li>
							@forelse ($post->tags as $tag)
							<li><a href="{{ url('/tags/'.$tag->slug) }}">{{$tag->name}}</a></li>
							@empty
							@endforelse
						</ul>
					</div>
				</div>
				<!-- /post tags -->

				<!-- post share -->
				<div class="section-row">
					<div class="post-share">
						<a href="#" class="social-facebook"><i class="fab fa-facebook-f"></i><span>Share</span></a>
						<a href="#" class="social-twitter"><i class="fab fa-twitter"></i><span>Tweet</span></a>
						<a href="#" class="social-whatsapp"><i class="fab fa-whatsapp"></i><span>WhatsApp</span></a>
						<a href="#" class="social-telegram"><i class="fab fa-telegram-plane"></i><span>Telegram</span></a>
						<a href="#" class="social-linkedin"><i class="fab fa-linkedin-in"></i><span>LinkedIn</span></a>
					</div>
				</div>

				<!-- /post share -->

				<!-- post author -->
				<div class="section-row">
					<div class="author media">
						<div class="media-left">
							<a href="{{ url('/author/'.$post->user_id) }}">
								<img class="author-img media-object" src="{{ asset('assets/img/undraw_profile.svg') }}" alt="">
							</a>
						</div>
						<div class="media-body">
							<ul>
								<li><a href="{{ url('/author/'.$post->user_id) }}" class="small media-author">{{$post->user->name}}</a></li>
							</ul>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						</div>
					</div>
				</div>
				<!-- /post author -->

				<!-- /related post -->
				<div>
					<div class="section-title">
						<h3 class="title">Related Posts</h3>
					</div>
					<div class="row">
						<!-- post -->
						@forelse ($post->getRelatedPosts($post) as $related)
						<div class="col-md-6">
							<div class="post post-sm">
								<a class="post-img" href="{{ url('/posts/'.$related->slug) }}"><img src="{{ asset('assets/local/img/'.$related->thumb) }}" alt=""></a>
								<div class="post-body">
									<div class="text-xs text-right">
										<i class="fas fa-eye"></i> {{$post->views}}
									</div>
									<div class="post-category">
										<a href="{{ url('/categories/'.$related->category->slug) }}">{{$related->category->name}}</a>
									</div>
									<h3 class="post-title title-sm"><a href="{{ url('/posts/'.$related->slug) }}">{{$related->title}}</a></h3>
									<ul class="post-meta">
										<li><a href="{{ url('/author/'.$related->user_id) }}">John Doe</a></li>
										<li>20 April 2018</li>
									</ul>
								</div>
							</div>
						</div>
						@empty
						@endforelse
						<!-- /post -->
					</div>
					<div class="text-center">
						{{ $post->getRelatedPosts($post)->links() }}
					</div>
				</div>
				<!-- /related post -->
			</div>
			<div class="col-md-4">
				<!-- post widget -->
				<div class="aside-widget">
					<div class="section-title">
						<h2 class="title"><span class="text-blog">Artikel</span>  Populer</h2>
					</div>
					<!-- post -->
					@forelse ($post->mostViewed as $popular)
					{{-- expr --}}
					<div class="post post-widget">
						<a class="post-img" href="{{ url('/posts/'.$popular->slug) }}"><img src="{{ asset('assets/local/img/'.$popular->thumb) }}"></a>
						<div class="post-body">
							<div class="post-category">
								@isset ($popular->category->name)
								<a href="{{ url('/categories/'.$popular->category->slug) }}">{{$popular->category->name}}</a>
								@endisset
							</div>
							<h3 class="post-title"><a href="{{ url('/posts/'.$popular->slug) }}">{{$popular->title}}</a></h3>
							<ul class="post-meta">
								<li><a href="{{ url('/posts/'.$popular->slug) }}">{{$popular->user->name}}</a></li>
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
						<h2 class="title"><span class="text-blog">DAFTAR</span>  Kategori ({{$categories->count()}})</h2>
					</div>
					<div class="category-widget">
						<ul>
							@forelse ($categories as $category)
							<li><a href="{{ url('/categories/'.$category->slug) }}">{{$category->name}} <span>{{$category->posts->count()}}</span></a></li>
							@empty
							@endforelse
						</ul>
					</div>
				</div>
				<!-- /category widget -->

				<!-- tags widget -->
				<div class="aside-widget">
					<div class="section-title">
						<h2 class="title"><span class="text-blog">DAFTAR</span>  Tag ({{$tags->count()}})</h2>
					</div>
					<div class="tags-widget">
						<ul>
							@forelse ($tags as $tag)
							<li><a href="{{ url('/tags/'.$tag->slug) }}" class="small">{{$tag->name}}</a></li>
							@empty
							@endforelse
						</ul>
					</div>
				</div>
				<!-- /tags widget -->
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->
@endsection