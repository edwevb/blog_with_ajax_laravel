@extends('layouts.admin_layouts', ['title' => 'Posts'])
@push('pageStyles')
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/selectize/selectize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/codemirror/codemirror.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/codemirror/theme/monokai.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/prism/prism.css') }}">
@endpush
@section('container')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="#">Article</a></li>
      <li class="breadcrumb-item active" aria-current="page">Posts</li>
    </ol>
  </nav>
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Posts</h1>
  <p class="mb-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda et, quis cupiditate dolor esse ab quam corporis accusantium magnam. Quae alias omnis quia praesentium quod ad blanditiis corrupti recusandae sapiente!</p>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="d-flex align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Table of data</h6>
        <h6 class="ml-auto btn btn-circle btn-primary btn-sm"><i class="fa fa-question"></i></h6>
      </div>
    </div>
    <div class="card-body">
      <div class="d-flex mb-3">
        <a href="javascript:void(0)" id="addButton" class="btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add data</a>
        <a href="#" class="btn btn-sm btn-primary shadow-sm ml-auto"><i class="fas fa-download fa-sm text-white-50"></i> Generate report
        </a>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="postTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th class="text-sm">TITLE</th>
              <th>AUTHOR</th>
              <th>VIEWED</th>
              <th>TOTAL TAGS</th>
              <th>PUBLISHED</th>
              <th>UPDATED</th>
              <th>ACTIONS</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
@include('admin.posts._modal')
@endsection

@push('dataTablesScripts')
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush

@push('ajax_scripts')
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendor/selectize/selectize.js') }}"></script>
<script src="{{ asset('assets/vendor/summernote/codemirror/codemirror.min.js') }}"></script>
<script src="{{ asset('assets/vendor/summernote/codemirror/xml.min.js') }}"></script>
<script src="{{ asset('assets/vendor/summernote/codemirror/formatting.min.js') }}"></script>
<script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/prism/prism.min.js') }}"></script>
<script src="{{ asset('assets/vendor/summernote/plugin/prettify/summernote-ext-prettify.min.js') }}"></script>
<script src="{{ asset('assets/local/post.min.js') }}"></script>
<script>
  var table = $('#postTable').DataTable({
    processing : true,
    serverSide: true,
    ajax:"{{route('api.posts')}}",
    columns: [
    {data: 'DT_RowIndex', name:'DT_RowIndex'},
    {data: 'title', name:'title'},
    {data: 'user.name', name:'user'},
    {data: 'views', name:'views'},
    {data: 'total_tags', name:'total_tags'},
    {data: 'created_at', name:'created_at'},
    {data: 'updated_at', name:'updated_at'},
    {
      data: 'action', name:'action', 
      orderable :false, 
      searchable:false
    }
    ]
  });
</script>
@endpush