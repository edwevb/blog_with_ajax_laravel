<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{$title ?? 'My Blog'}}</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/local/styles.css') }}" rel="stylesheet">
  @stack('pageStyles')
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    {{-- Sidebar --}}
    @include('layouts.navigation.sidebar')
    
    {{-- Content Wrapper --}}
    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        {{-- Topbar --}}
        @include('layouts.navigation.topbar')

        {{-- Main content --}}
        @yield('container')
      </div>  
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top" style="display: inline;">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
  @stack('dataTablesScripts')
  @stack('ajax_scripts')
</body>
</html>