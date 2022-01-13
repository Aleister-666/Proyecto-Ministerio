@extends('layout/workplace_layout')

@section('active-6')
	active
@endsection

@section('title')
	Solicitud para la Gran Mision Vivienda Venezuela
@endsection

@section('main_content')
	@include('gmvv_requests/partials/form', [
		'form_title' => 'Requerimientos de la solicitud',
		'form_action' => route('create_gmvv_request_path'),
		'form_method' => 'POST',

		'first_name' => null,
		'first_surname' => null,
		'second_name' => null,
		'second_surname' => null,
		'cedula' => null,
		'email' => null,
		'telefono' => null,
		'sex' => null
	])

@endsection

@section('js')
	<script src="{{asset('js/common/disabled_form.js')}}"></script>
@endsection