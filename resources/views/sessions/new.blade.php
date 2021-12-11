@extends('layout/application')

@section('extra_css')
	<link rel="stylesheet" href="{{ asset('css/sessions/login.css') }}">
@endsection


@section('content')

	<div class="login-background justify-content-center align-items-center">
	</div>

	<div class="login-content">
		<div class="row justify-content-center align-items-center p-3 rounded-3 text-white bg-red-dark-transparent">

			<div class="text-center">
				<img src="{{asset('images/sessions/logo GMVV.png')}}" alt="">
			</div>
			<form action="{{route('create_session_path')}}" method="POST">

				@csrf

				<h1>Login</h1>
			
				@error('message')
					<div class="alert alert-danger text-center">
						<p class="m-0">{{$message}}</p>
					</div>
				@enderror

				<div class="mb-3">
					<label for="cedula" class="form-label">Cedula de Identidad</label>
					<input type="tel" name="cedula" class="form-control">
				</div>

				@error('cedula')
					<div class="alert alert-danger text-center">
						<p class="m-0">{{$message}}</p>
					</div>
				@enderror

				<div class="mb-3">
					<label for="password" class="form-label">Contraseña</label>
					<input type="password" name="password" class="form-control">
				</div>

				@error('password')
					<div class="alert alert-danger text-center">
						<p class="m-0">{{$message}}</p>
					</div>
				@enderror

				<div class="mb-3 form-check">
					<input type="checkbox" name="remember" class="form-check-input" value="remember">
					<label class="form-check-label">Recordarme</label>
				</div>

				<button type="submit" class="btn btn-danger">Enviar</button>
		</form>
		</div>
	</div>

@endsection