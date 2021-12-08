@extends('layout/workplace_layout')

@section('active-2')
	active
@endsection

@section('title')
	Editar Archivo
@endsection

@section('main_content')

	@include('workplace/partials/form_documents', [
		'action_form' => 'update_document_path',
		'action_form_parameter' => $document->id,
		'method_form' => 'PUT',
		'title_value' => $document->title,
		'description_value' => $document->description,
		'submit_value' => 'Actualizar Documento'
	])

@endsection