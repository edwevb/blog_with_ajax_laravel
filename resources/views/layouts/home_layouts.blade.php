<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.head')
<body>
	@include('layouts.home.header')
	@yield('container')
	@include('layouts.home.footer')
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('assets/vendor/sweet-alert/sweetalert2.js') }}"></script>
	<script>
		@if ($msg = session()->get('err'))
		<?= 'Swal.fire({
			icon: "question",
			title: "Oops...",
			text: "'.$msg.'",
			showCloseButton: true,
			confirmButtonColor: "#00ADB5",
		})';?>
		@endif
	</script>
	<script src="{{ asset('assets/blog/js/scripts.js') }}"></script>
	@stack('share')
	@stack('editor_scripts')
</body>
</html>