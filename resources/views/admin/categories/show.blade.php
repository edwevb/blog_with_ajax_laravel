@extends('layouts.admin_layouts', ['title' => $category->name])
@push('pageStyles')
<link rel="stylesheet" href="{{ asset('assets/vendor/selectize/selectize.css') }}">
@endpush
@section('container')
<div class="container-fluid">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="#">Article</a></li>
			<li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}">Categories</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
		</ol>
	</nav>
	<h1 class="h3 mb-2 text-gray-800">Category: {{$category->name}}</h1>
	<h6 class="m-0 font-weight-bold text-primary my-3">List of posts</h6>
	<button id="addButton" class="btn btn-sm btn-success shadow-sm mb-3"><i class="fas fa-plus fa-sm text-white-50"></i> Add Post</button>
	<div class="row row-cols-1 row-cols-md-2">
		@forelse ($category->posts as $post)
		<div class="col mb-3">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">{{$post->title}}</h5>
					<h6 class="card-subtitle mb-2 text-xs">
						Published: {{$post->created_at->diffForHumans()}}, 
						by {{$post->user->name}}
					</h6>
					<div class="postBody">
						{!!html_entity_decode($post->body)!!}
					</div>
					<div class="mt-3 small">
						<a href="{{ url('/admin/posts/'.$post->slug)}}" class="card-link text-info"><i class="fa fa-search-plus"></i></a>
						<a href="javascript:void(0)" id="removePost" class="card-link text-danger" name="{{$post->slug}}"><i class="fa fa-trash"></i></a>
					</div>
				</div>
			</div>
		</div>
		@empty
		<h5 class="m-4">No posts has been made for {{$category->name}}'s Category</h5>
		@endforelse
	</div>
</div>

<div class="modal fade" id="addPosts" tabindex="-1" aria-labelledby="addPostsLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addPostsLabel">Add Post</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="postForm">
					@csrf
					<div class="form-group">
						<select class="form-control" id="posts" name="posts" autocomplete="off" placeholder="Select posts" autofocus>
							<optgroup class="small text-gray-800" label="List Posts">
								@foreach ($dataPosts as $post)
								<option value="{{$post->id}}">{{$post->title}}</option>
								@endforeach
							</optgroup>
						</select>
					</div>
					<button type="submit" class="btn btn-primary btn-save">Save changes</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('ajax_scripts')
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendor/selectize/selectize.js') }}"></script>
<script>

	let $selectPosts =  $('#posts').selectize({
		allowEmptyOption:false,
		plugins:["remove_button","restore_on_backspace"]
	});

	$(document).on('click', '#addButton',  function() {
		document.getElementById('postForm').reset();
		$('#addPosts').modal('show');
		$selectPosts[0].selectize.setValue();
	});

	$('#addPosts form').on('submit', function(e){
		e.preventDefault();
		const url = "{{ url('/admin/categories/add-post/'.$category->id) }}",
		data = {
			_token	: $('input[name=_token]').val(),
			posts 	: $('#posts').val()
		};

		$.ajax({
			type:'PUT',
			url:url,
			data:data,
			dataType:'json',
			success:(res) => {
				successAlert(res);
				$('#addPosts').modal('hide');
			},
			error:(xhr) => {
				console.log(xhr.responseText);
			}
		});
	});

	$(document).on('click', '#removePost',  function() {
		const _token = $('meta[name="csrf-token"]').attr('content'),
		url = "{{ url('/admin/categories/remove-post/'.$category->id) }}",
		data = {
			_token:_token,
			posts: $(this).attr("name")
		};

		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		})
		.then((res) => {
			if (res.isConfirmed) {
				$.ajax({
					type: "PUT",
					url: url,
					data: data,
					dataType: 'json',
					success: function (res) {
						successAlert(res);
					},
					error: (xhr) => {
						console.log(xhr.responseText);
					}
				});
			}
		});
	});

	const successAlert = (res) => {
		Swal.fire({
			title: 'Loading..',
			timer: 2000,
			timerProgressBar: true,
			allowOutsideClick:false,
			allowEscapeKey:false,
			allowEnterKey:false,
			didOpen: () => {
				Swal.showLoading()
			}
		}).then(() => {
			Swal.fire({
				icon: 'success',
				iconColor:'#38C172',
				title: res.message,
				showCloseButton: true,
			}).then(e =>{
				location.reload();
			});
		});
	}
</script>
@endpush