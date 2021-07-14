@extends('layouts.admin_layouts', ['title', 'Change Password'])
@section('container')

<div class="container">
	<div class="card o-hidden border-0 shadow-lg my-5">
		<div class="card-body p-0">
			<!-- Nested Row within Card Body -->
			<div class="p-5">
				<div class="text-center">
					<h1 class="h4 text-gray-900 mb-4">Change Password</h1>
				</div>
				<form action="{{ url('/admin/change-password') }}" class="user" method="POST">
					@csrf
					@foreach ($errors->all() as $error)
					<p class="text-danger text-center">{{ $error }}</p>
					@endforeach 
					<div class="form-group">
						<div class="col-md-6 mb-3 mb-3 mx-auto">
							<input type="password" class="form-control form-control-user" id="current_password" name="current_password"
							placeholder="Current Password">
						</div>
						<div class="col-md-6 mb-3 mb-3 mx-auto">
							<input type="password" class="form-control form-control-user" id="new_password" name="new_password"
							placeholder="New Password">
						</div>
						<div class="col-md-6 mb-3 mb-3 mx-auto">
							<input type="password" class="form-control form-control-user" id="new_confirm_password" name="new_confirm_password"
							placeholder="Confirm New Password">
						</div>
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary btn-user">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
@endsection