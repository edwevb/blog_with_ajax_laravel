<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="application-name" content="Edward Blog">
  <meta name="description" content="Sebuah blog sederhana untuk membagikan informasi.">
  <meta name="keywords" content="blog, teknologi, informasi">
  <meta name="author" content="Edward Evbert Angkouw">

  <!-- Primary Meta Tags -->
  <title>{{$title ?? 'Edward Blog'}}</title>
  <meta name="description" content="Sebuah blog sederhana untuk membagikan informasi.">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website blog">
  <meta property="og:url" content="{{ request()->url() }}">
  <meta property="og:title" content="{{$title ?? 'Edward Blog'}}">
  <meta property="og:description" content="Sebuah blog sederhana untuk membagikan informasi.">
  <meta property="og:image" content="{{$image ?? ''}}">

  <!-- Twitter -->
  <meta property="twitter:card" content="website_blog">
  <meta property="twitter:url" content="{{ request()->url() }}">
  <meta property="twitter:title" content="{{$title ?? 'Edward Blog'}}">
  <meta property="twitter:description" content="Simple blog for sharing information">
  <meta property="twitter:image" content="{{$image ?? ''}}">

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CMuli:400,700" rel="stylesheet">

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="{{ asset('assets/blog/css/bootstrap.min.css') }}" />

  <!-- Font Awesome Icon -->
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="{{ asset('assets/blog/css/style.css') }}" />

</head>
<body>
  @include('layouts.home.header')

  @yield('container')

  @include('layouts.home.footer')
  <!-- jQuery Plugins -->
  <script src="{{ asset('assets/blog/js/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/blog/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/blog/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('assets/blog/js/main.js') }}"></script>

</body>

</html>