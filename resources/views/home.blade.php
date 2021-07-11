@extends('layouts.home_layouts')
@section('container')
<!-- PAGE HEADER -->
<div class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-offset-1 col-md-10 text-center">
        <p class="lead">Selamat datang diwahana menulis saya, semoga semua informasi yang terkolektif disini dapat bermanfaat bagi anda!</p>
        <div class="card-img">
          <a class="post-img img-header" href="blog-post.html"><img src="{{ asset('assets/img/undraw_profile.svg') }}" alt=""></a>
        </div>
        <div class="loadmore text-center">
          <a href="#new-article" class="primary-button">Start read!</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /PAGE HEADER -->
<div class="section" id="new-article">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <!-- row -->
        <div class="row">
          <div class="col-md-12">
            <h3 class="toUpperCase"><span class="text-blog">ARTIKEL</span> TERBARU</h3>
          </div>
          <!-- post -->
          @forelse ($posts as $post)
          <article>
            <div class="col-md-6">
              <div class="post new-article">
                <a class="post-img" href="{{ url('/posts/'.$post->slug) }}"><img src="{{ asset('assets/local/img/'.$post->thumb) }}"></a>
                <div class="post-body">
                  <div class="post-category">
                    <div class="text-xs text-right">
                      <i class="fas fa-eye"></i> {{$post->views}}
                    </div>
                    @isset ($post->category)
                    <a href="{{ url('/categories/'.$post->category->slug) }}">{{$post->category->name}}</a>
                    @endisset
                  </div>
                  <h3 class="post-title"><a href="{{ url('/posts/'.$post->slug) }}">{{$post->title}}</a></h3>
                  <p>{!! \Str::limit($post->body, 100)!!}</p>
                  <ul class="post-meta">
                    <li><a href="{{ url('/author/'.$post->user_id) }}">{{$post->user->name}}</a></li>
                    <li>{{$post->created_at->diffForHumans()}}</li>
                  </ul>
                  <div class="tags-widget">
                    <ul>
                      @forelse ($post->tags as $tag)
                      <li><a class="small" href="{{ url('/tags/'.$tag->slug) }}">{{$tag->name}}</a></li>
                      @empty
                      @endforelse
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </article>
          @empty
          @endforelse
          <!-- /post -->
        </div>
        <!-- /row -->
        <div class="text-center">
          {!! $posts->render() !!}
        </div>
      </div>
      <div class="col-md-4">
        <!-- post widget -->
        <div class="aside-widget">
          <div class="section-title">
            <h2 class="title"><span class="text-blog">ARTIKEL</span> Populer</h2>
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
      </div>
    </div>
  </div>
</div>

<!-- SECTION -->
<div class="section bg-light">
  <!-- container -->
  <div class="container bg-white middle-post">
    <h3 class="toUpperCase"><span class="text-blog">ARTIKEL</span> BERDASARKAN KATEGORI</h3>
    <!-- row -->
    <div class="row">
      <div class="col-md-8">
        <!-- row -->
        {{-- Kategori --}}
        <div class="row">
          @forelse ($categories as $category)
          <div class="col-md-12">
            <h5 class="toUpperCase">{{$category->name}}</h5>
          </div>
          <!-- post -->
          @forelse ($category->posts->take(3) as $post)
          <div class="col-md-4">
            <div class="post post-sm">
              <a class="post-img" href="{{ url('/posts/'.$post->slug) }}"><img src="{{ asset('assets/local/img/'.$post->thumb) }}" alt=""></a>
              <div class="post-body">
                <h3 class="post-title title-sm"><a href="{{ url('/posts/'.$post->slug) }}">{{$post->title}}</a></h3>
                <ul class="post-meta">
                  <li><a href="{{ url('/author/'.$post->user_id) }}">{{$post->user->name}}</a></li>
                  <li>{{$post->created_at->format('F, Y')}}</li>
                </ul>
              </div>
            </div>
          </div>
          @empty
          @endforelse
          @empty
          @endforelse
          <!-- /post -->
        </div>
        <div class="loadmore text-center">
          <a href="{{ url('/categories/'.$category->slug) }}" class="primary-button">Load More</a>
        </div>
        <!-- /row -->
      </div>
      <div class="col-md-4">
        <!-- category widget -->
        <div class="aside-widget">
          <div class="section-title">
            <h2 class="title"><span class="text-blog">DAFTAR</span> Kategori({{$categories->count()}})</h2>
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
            <h2 class="title"><span class="text-blog">DAFTAR</span> Tag ({{$tags->count()}})</h2>
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

<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <h3><span class="text-blog">POPULER</span> BERDASARKAN TAG</h3>
    {{-- Tag --}}
    <div class="row">
      @forelse ($tags as $tag)
      <div class="col-md-4">
        <h5 class="toUpperCase">{{$tag->name}}</h5>
        <div class="post post-sm">
          <a class="post-img" href="{{ url('/posts/'.$tag->mostViewedByTag->slug) }}"><img src="{{ asset('assets/local/img/'.$tag->mostViewedByTag->thumb) }}" alt=""></a>
          <div class="post-body">
            <h3 class="post-title title-sm"><a href="{{ url('/posts/'.$tag->mostViewedByTag->slug) }}">{{$tag->mostViewedByTag->title}}</a></h3>
            <ul class="post-meta">
              <li><a href="author.html">{{$tag->mostViewedByTag->user->name}}</a></li>
              <li>{{$tag->mostViewedByTag->created_at->format('F, Y')}}</li>
            </ul>
          </div>
        </div>
      </div>
      @empty
      @endforelse
      <!-- /post -->
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <h3 class="toUpperCase"><span class="text-blog">ARTIKEL</span> BARU DIPERBAHARUI</h3>
      @forelse ($post->lastPost as $lastPost)
      <div class="col-md-6">
        <!-- post -->
        <div class="post post-row">
          <a class="post-img" href="{{ url('/posts/'.$lastPost->slug) }}"><img src="{{ asset('assets/local/img/'.$lastPost->thumb) }}" alt=""></a>
          <div class="post-body">
            @isset($lastPost->category)
            <div class="post-category">
              <a href="{{ url('/posts/'.$lastPost->category->slug) }}">{{$lastPost->category->name}}</a>
            </div>
            @endisset
            <h3 class="post-title"><a href="{{ url('/posts/'.$lastPost->slug) }}">{{$lastPost->title}}</a></h3>
            <p>{!! \Str::limit($lastPost->body, 100)!!}</p>
            <ul class="post-meta">
              <li><a href="author.html">{{$lastPost->user->name}}</a></li>
              <li>{{$lastPost->created_at->diffForHumans()}}</li>
            </ul>
          </div>
        </div>
        <!-- /post -->
      </div>
      @empty
      @endforelse
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->

@endsection