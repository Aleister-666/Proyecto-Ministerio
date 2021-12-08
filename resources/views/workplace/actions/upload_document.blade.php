@extends('layout/workplace_layout')

@section('active-6')
	active
@endsection

@section('title')
	Subir Archivo
@endsection

@section('main_content')

	@include('workplace/partials/form_documents', [
		'action_form' => 'create_document_path',
		'action_form_parameter' => null,
		'method_form' => null,
		'title_value' => null,
		'description_value' => null,
		'submit_value' => 'Subir Documento'
	])

@endsection
