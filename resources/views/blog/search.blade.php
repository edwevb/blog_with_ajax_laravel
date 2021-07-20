@extends('layouts.home_layouts', ['title' => 'Search | '.$post->count()])
@section('container')
<header class="masthead" style="background-image: url({{ asset('assets/blog/img/wave-dark.svg') }})">
  <div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-9">
        <div class="site-heading">
          <h1>SEARCH RESULTS</h1>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Main Content-->
<div class="container-md">
  <div class="row">
    @foreach ($posts as $post)
    <div class="col-md-6 text-center mx-auto">
      <!-- Post-->
      <div class="post-preview">
        <a href="{{ url('/posts/'.$post->slug) }}">
          <h5 class="post-title">{{$post->title}}</h5>
        </a>
        @isset ($post->category)
        <div class="post-subtitle">
          Category: <a href="{{ url('/categories/'.$post->category->slug) }}">{{$post->category->name}}</a>
        </div>
        @endisset
        <p class="post-meta">
          Posted by
          <a href="{{ url('/about') }}">{{$post->user->name}}</a>
          on {{$post->created_at->format('F d, Y')}}
        </p>
      </div>
      <!-- /Post-->
    </div>
    @endforeach
    <div class="d-flex">
      <div class="mx-auto">
        {!! $posts->links() !!}
      </div>
    </div>
  </div>
</div>
@endsection
