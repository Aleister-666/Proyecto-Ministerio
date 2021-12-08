@extends('layout/workplace_layout')

@section('active-4')
	active
@endsection

@section('main_content')
	@include('users/partials/form_user', [
		'form_method' => 'PUT',
		'title_action' => 'Edicion de Usuario',
		'title_form' => 'Formulario de Actualizacion',
		'form_action' => 'update_user_path',
		'first_name_value' => $user->names->first_name,
		'second_name_value' => $user->names->second_name,
		'first_surname_value' => $user->names->first_surname,
		'second_surname_value' => $user->names->second_surname,
		'cedula_value' => $user->cedula,
		'email_value' => $user->email,
		'telefono_value' => $user->telefono,
		'submit_value' => 'Actualizar'
	])
@endsection
