@extends('layouts.admin_layouts', ['title' => 'Tags'])
@push('pageStyles')
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush
@section('container')
<div class="container-fluid">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="#">Article</a></li>
			<li class="breadcrumb-item active" aria-current="page">Tags</li>
		</ol>
	</nav>
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Tags</h1>
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
				<table class="table table-bordered" id="tagTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>NAME</th>
							<th>TOTAL POSTS</th>
							<th>CREATED</th>
							<th>ACTIONS</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
{{-- MODAL --}}
@include('admin.tags._modal')

@endsection

@push('dataTablesScripts')
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush
@push('ajax_scripts')
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/local/tag.js') }}"></script>
<script>
	var table = $('#tagTable').DataTable({
		processing : true,
		serverSide: true,
		ajax:"{{route('api.tags')}}",
		columns: [
		{data: 'DT_RowIndex', name:'DT_RowIndex'},
		{data: 'name', name:'name'},
		{data: 'total_posts', name:'total_posts'},
		{data: 'created_at', name:'created_at'},
		{
			data: 'action', name:'action', 
			orderable :false, 
			searchable:false
		}
		]
	});
</script>
@endpush