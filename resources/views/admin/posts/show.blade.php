@extends('layouts.admin_layouts', ['title' => $post->title])
@push('pageStyles')
<link rel="stylesheet" href="{{ asset('assets/vendor/selectize/selectize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote.css') }}">
@endpush
@section('container')
<div class="container-fluid">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="#">Article</a></li>
			<li class="breadcrumb-item"><a href="{{ url('/admin/posts') }}">Posts</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
		</ol>
	</nav>
	<h1 class="h3 mb-2 text-gray-800">Details Post</h1>
	<div class="card shadow-sm my-4">
		<img src="{{ asset('assets/local/img/'.$post->thumb) }}" class="card-img-top" alt="{{$post->slug}}">
		<div class="card-header py-3 bg-white">
			<div class="d-flex flex-row align-items-center justify-content-between">
				<h5 class="m-0 font-weight-bold text-primary">{{$post->title}}</h5>
				<div class="dropdown no-arrow">
					<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
						<div class="dropdown-header">Actions:</div>
						<a class="dropdown-item" href="#">Likes</a>
						<a class="dropdown-item" href="#">Views</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Comments</a>
					</div>
				</div>
			</div>
			<div class="d-flex flex-row mt-2">
				<p class="text-xs mr-2">Published : {{$post->created_at->diffForHumans()}}</p>
				<p class="text-xs">Updated : {{$post->updated_at->diffForHumans()}}</p>
			</div>
			<div>Author : {{$post->user->name}}</div>
		</div>
		<!-- Card Body -->
		<div class="card-body">
			{!! $post->body !!}
		</div>
		<div class="card-footer bg-white">
			<div class="row align-items-center justify-content-between">
				<div class="my-2">
					@isset ($post->category)
					Categories: <a class="small" href="{{ url('/admin/categories/'.$post->category->slug) }}">{{$post->category->name}}</a>
					@else
					Categories: None
					@endisset
				</div>
				<div class="my-2">
					Tags:
					@forelse ($post->tags as $tags)
					<a id="postTag" class="small" href="#">#{{$tags->name}}</a>
					@empty
					None
					@endforelse
				</div>
			</div>
		</div>
	</div>

	<div class="d-sm-inline-block mb-3 align-items-center">
		<button id="editButton" class="btn btn-warning" value="{{$post->id}}">
			<i class="fas fa-edit"></i>
			<span class="text">Edit</span>
		</button>
		<button id="deleteButton" class="btn btn-danger">
			<i class="fas fa-trash"></i>
			<span class="text">Delete</span>
		</button>
	</div>
</div>

<div class="modal fade" id="postsModal" tabindex="-1" aria-labelledby="postsModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="postsModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="postForm" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" class="form-control" id="title" name="title" autocomplete="off">
					</div>
					<div class="row row-cols-1 row-cols-md-2">
						<div class="col">
							<div class="form-group">
								<label for="category">Select Category</label>
								<select class="form-control" id="category" name="category_id">
									@foreach ($dataCategories as $categories)
									<option value={{$categories->id}}>{{$categories->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="tags">Tags</label>
								<select class="form-control" id="tags" name="tags" multiple="multiple">
									@foreach ($dataTags as $tags)
									<option value={{$tags->name}}>{{$tags->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="body">Body</label>
						<textarea class="form-control" id="body" name="body" rows="3"></textarea>
					</div>
					<button type="submit" class="btn btn-primary btn-save" value="update">Save changes</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('ajax_scripts')
<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendor/selectize/selectize.js') }}"></script>
<script src="{{ asset('assets/vendor/summernote/summernote.js') }}"></script>
<script>

	$('#body').summernote({
		placeholder: 'Write here..',
		tabsize: 2,
		height: 350
	});

	let $selectCategory = $('#category').selectize({
		plugins: ["restore_on_backspace"]
	}),

	$selectTags =  $('#tags').selectize({
		plugins: ["remove_button","restore_on_backspace"],
		preload: true,
		create: true,
		persist:false,
		allowEmptyOption:false,
		maxItems: 5
	});


	$(document).on('click', '#editButton',  function() {
		removeFormValidation();
		const url = "{{ url('/admin/posts/'.$post->id.'/edit') }}";
		$.get(url, function(res){
			$('.btn-save').attr('name', res.id)
			$('#postsModal').modal('show');
			$('#title').val(res.title);
			$('#body').summernote('code', res.body);
			$selectCategory[0].selectize.setValue(res.category_id);
			$selectTags[0].selectize.setValue(res.tags.map(value => {
				return value.name;
			}));
		});
	});

	$('#postsModal form').on('submit', function(e){
		e.preventDefault();
		removeFormValidation();
		const url = "{{ url('/admin/posts/'.$post->id) }}",
		data = {
			_token     : $('input[name=_token]').val(),
			title      : $('#title').val(),
			body       : $('#body').summernote('code'), 
			category_id:  $('#category').val(),
			tags       :  $('#tags').val()
		};

		$.ajax({
			type: "PUT",
			url: url,
			data: data, 
			dataType: 'JSON',
			success: (res)=>{
				successAlert(res);
				$('#postsModal').modal('hide');
			},
			error: (xhr)=>{
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Please fill the required field!',
					showCloseButton: true
				}).then(()=>{
					formValidate(xhr);
				});
			}
		});
	});

	$(document).on('click','#deleteButton',function(){
		const _token = $('meta[name="csrf-token"]').attr('content'),
		url = "{{ url('/admin/posts/'.$post->id) }}",
		data = {
			_token:_token
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
					type: "DELETE",
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
			}).then(()=>{
				if (res.type == 'update') {
					location.reload();
				}else{
					location.assign("{{ url('/admin/posts') }}");
				}
			});
		});
	}

	const formValidate = (xhr) => {
		const res = xhr.responseJSON;
		let keys = "";
		if ($.isEmptyObject(res) == false) {
			$.each(res.errors, (key, value) => {
				if(key.indexOf(".") != -1){
					const arr = key.split(".");
					keys = $('#'+arr[0])
				}else{
					keys = $('#'+key)
				}
				keys.closest('.form-control')
				.addClass('is-invalid')
				.closest('.form-group')
				.append(`<div class="invalid-feedback">${value}</div>`);
			});
		}
	}

	const removeFormValidation = () => {
		const form = $('#postsModal');
		form.find('.invalid-feedback').remove();
		form.find('.form-control').removeClass('is-invalid');
	}
</script>
@endpush