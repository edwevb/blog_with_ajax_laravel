<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="application-name" content="Edward Blog">
  <meta name="title" content="Edward Blog">
  <meta name="description" content="@description">
  <meta name="keywords" content="blog, typography, technology, information">
  <meta name="author" content="Edward Evbert Angkouw">

  <!-- Primary Meta Tags -->
  <title>{{$title ?? config('app.name')}}</title>
  <meta name="description" content="@description">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ request()->url() }}">
  <meta property="og:title" content="{{$title ?? 'Edward Blog'}}">
  <meta property="og:description" content="@description">
  <meta property="og:image" content="{{$image ?? asset('assets/img/logo.png') }}">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ request()->url() }}">
  <meta property="twitter:title" content="{{$title ?? 'Edward Blog'}}">
  <meta property="twitter:description" content="@description">
  <meta property="twitter:image" content="{{$image ?? asset('assets/img/logo.png') }}">

  <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat :300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link type="text/css" rel="stylesheet" href="{{ asset('assets/blog/css/bootstrap-5-styles.min.css') }}" />
  <link type="text/css" rel="stylesheet" href="{{ asset('assets/blog/css/page.styles.min.css') }}" />
  @stack('editor_styles')
</head>