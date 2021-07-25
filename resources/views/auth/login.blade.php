<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Mimalabs - Sistem Akademik Nilai</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->
			<link rel="icon" type="image/png" href="{{ asset('assets/login/images/icons/favicon.ico') }}"/>
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/bootstrap/css/bootstrap.min.css') }}">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/animate/animate.css') }}">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/css-hamburgers/hamburgers.min.css') }}">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/animsition/css/animsition.min.css') }}">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/select2/select2.min.css') }}">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/daterangepicker/daterangepicker.css') }}">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/util.css') }}">
			<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/main.css') }}">
		<!--===============================================================================================-->
		<!-- Sweet Alert -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
	</head>
	<body>
		<div class="limiter">
			<div class="container-login100" style="background-image: url('../assets/login/images/bg-01.jpg');">
				<div class="wrap-login100 p-t-30 p-b-50">
					<span class="login100-form-title p-b-41">
						Account Login
					</span>
					<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@if (session('status'))
						<span class="badge badge-info"><strong>{{ session('status') }}</strong></span>
					@endif
					@if (session('failed'))
						<span class="badge badge-danger"><strong>{{ session('failed') }}</strong></span>
					@endif -->
					<form method="POST" action="{{ route('login') }}" class="login100-form validate-form p-b-33 p-t-5" autocomplete="off">
						{{ csrf_field() }}
						<div class="wrap-input100 validate-input {{ $errors->has('email') ? ' has-error' : '' }}" data-validate = "Enter email">
							<input class="input100  @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
							<span class="focus-input100" data-placeholder="&#xe82a;"></span>
						</div>

						<div class="wrap-input100 validate-input {{ $errors->has('password') ? ' has-error' : '' }}" data-validate="Enter password">
							<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Password">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
							<span class="focus-input100" data-placeholder="&#xe80f;"></span>
						</div>

						<div class="container-login100-form-btn m-t-32">
							<button class="login100-form-btn">
								{{ __('Login') }}
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		@include('sweetalert::alert')
		<div id="dropDownSelect1"></div>
		<!--===============================================================================================-->
			<script src="{{ asset('assets/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
		<!--===============================================================================================-->
			<script src="{{ asset('assets/login/vendor/animsition/js/animsition.min.js') }}"></script>
		<!--===============================================================================================-->
			<script src="{{ asset('assets/login/vendor/bootstrap/js/popper.js') }}"></script>
			<script src="{{ asset('assets/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
		<!--===============================================================================================-->
			<script src="{{ asset('assets/login/vendor/select2/select2.min.js') }}"></script>
		<!--===============================================================================================-->
			<script src="{{ asset('assets/login/vendor/daterangepicker/moment.min.js') }}"></script>
			<script src="{{ asset('assets/login/vendor/daterangepicker/daterangepicker.js') }}"></script>
		<!--===============================================================================================-->
			<script src="{{ asset('assets/login/vendor/countdowntime/countdowntime.js') }}"></script>
		<!--===============================================================================================-->
		<!-- Sweet Alert -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
		<script src="{{ asset('assets/login/js/main.js') }}"></script>
	</body>
</html>
