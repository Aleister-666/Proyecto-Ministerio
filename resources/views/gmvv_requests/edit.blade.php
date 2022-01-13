@extends('layout/workplace_layout')

@section('active-6')
	active
@endsection

@section('title')
	Solicitud para la Gran Mision Vivienda Venezuela
@endsection

@section('main_content')

	@include('gmvv_requests/partials/form', [
		'form_title' => 'Editar solicitud',
		'form_action' => route('update_gmvv_request_path', $client->gmvv_request->id),
		'form_method' => 'PUT',

		'first_name' => $client->names->first_name,
		'first_surname' => $client->names->first_surname,
		'second_name' => $client->names->second_name,
		'second_surname' => $client->names->second_surname,
		'cedula' => $client->cedula,
		'email' => $client->email,
		'telefono' => $client->telefono,
		'sex' => $client->sex,
	])

@endsection

@section('js')
	<script src="{{asset('js/common/disabled_form.js')}}"></script>
@endsection