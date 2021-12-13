@extends('layout/workplace_layout')

@section('active-4')
	active
@endsection

@section('title')
	Crear Nuevo Usuario
@endsection

@section('main_content')
	@include('users/partials/form_user', [
		'form_method' => 'POST',
		'title_action' => 'Registro de Usuario',
		'title_form' => 'Formulario de Registro',
		'form_action' => 'create_user_path',
		'first_name_value' => null,
		'second_name_value' => null,
		'first_surname_value' => null,
		'second_surname_value' => null,
		'cedula_value' => null,
		'email_value' => null,
		'telefono_value' => null,
		'submit_value' => 'Registrar'
	])
@endsection

@section('js')
	<script src="{{asset('js/common/disabled_form.js')}}"></script>
@endsection