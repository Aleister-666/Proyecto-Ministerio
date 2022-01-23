@extends('layout/workplace_layout')

@section('active-5')
	active
@endsection

@section('title')
	Reportes de Solicitudes para la Gran Mision Vivienda Venezuela
@endsection

@section('main_content')

	<div class="my-4">
		@if ($message = Session::get('success'))
		  <div class="alert alert-success text-center">
		    {{$message}}
		  </div>
		@else
		 	@error('message')
		 		<div class="alert alert-danger text-center">
		 			{{$message}}
		 		</div>
		 	@enderror
		@endif
		
		<input type="text" id="search" name="cedula" placeholder="Cedula a buscar..." class="form-control" autocomplete="off" data-search-path="{{route('search_gmvv_request_path')}}">
	</div>

	<div class="position-relative">
		
		<div class="table-responsive">
		  <table class="table table-striped table-hover table-sm">
		    <thead>
		      <tr>
		        <th scope="col">Cedula</th>
		        <th scope="col">Nombres</th>
		        <th scope="col">Apellidos</th>
		        <th scope="col">Correo Electronico</th>
		        <th scope="col">Telefono</th>
		        <th scope="col">Estado de la Solicitud</th>
		        <th scope="col">Acciones</th>
		      </tr>
		    </thead>
		    <tbody id="results">
		      @foreach ($clients as $client)

		      	<tr id ="client-{{$client->id}}">
		      		<td id="cedula-{{$client->id}}">{{$client->cedula}}</td>
		      		<td id="names-{{$client->id}}">{{$client->names->first_name . " " . $client->names->second_name}}</td>
		      		<td id="surnames-{{$client->id}}">{{$client->names->first_surname . " " . $client->names->second_surname}}</td>
		      		<td>{{$client->email ? $client->email : 'Sin Correo'}}</td>
		      		<td>{{$client->telefono ? $client->telefono : 'Sin Telefono'}}</td>

		      		<td title="{{$client->gmvv_request->task->state->name}}">
		      			@switch($client->gmvv_request->task->state->id)
		      			    @case(1)
		      			      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-clock-fill text-warning" viewBox="0 0 16 16">
		      			        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
		      			      </svg>
	      			        @break
		      					@case(2)
		      					  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
		      					    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
		      					  </svg>
	      					    @break
		      					@case(3)
		      						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill text-danger" viewBox="0 0 16 16">
		      						  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
		      						</svg>
	      					    @break
		      			@endswitch
		      			{{$client->gmvv_request->task->state->name}}
		      		</td>
		      		{{-- <td>{{$client->gmvv_request->task->state->name}}</td> --}}

		      		<td>
		      			<div class="btn-group" role="group" aria-label="Basic outlined example">

		      				<a href="{{route('edit_gmvv_request_path', $client->gmvv_request->id)}}" title="Editar Peticion" class="btn btn-outline-secondary shadow-none">
		      					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
		      					  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
		      					  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
		      					</svg>
		      				</a>

		      				<button type="button" class="btn btn-outline-primary shadow-none" title="Descargar Archivos de Solicitud" data-download="true" data-client-id="{{$client->id}}" data-path-download="{{route('download_gmvv_request_path', $client->id)}}" data-path-files="{{route('files_gmvv_request_path')}}" data-bs-toggle="modal" data-bs-target="#files">
		      					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
		      					  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"></path>
		      					</svg>
		      				</button>
		      				
		      			  <button type="button" class="btn btn-outline-danger shadow-none" title="Eliminar Solicitud" data-delete="true" data-form-action="{{route('destroy_gmvv_request_path', $client->id)}}" data-bs-toggle="modal" data-bs-target="#confirmation-delete">
		      			  	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
		      			  	  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
		      			  	</svg>
		      			  </button>

		      			</div>
		      		</td>
		      	</tr>

		      @endforeach
		    </tbody>
		    
		  </table>

		  {{$clients->links()}}
		</div>

		<div id="spinner-box" class="row justify-content-center align-items-center position-absolute top-0 bottom-0 w-100 bg-white-t-a visually-hidden">
			<div class="text-center my-2">
				<div class="spinner-border text-primary" role="status">
				  <span class="visually-hidden">Loading...</span>
				</div>
			</div>
		</div>	

	</div>

  <div id="modals">
  	
	  @include('commons/confirmation_modal', [
	  	'modal_id' => 'confirmation-delete',
	  	'modal_title' => "Borrar Cliente y Registro",
	  	'modal_action' => "Borrar",
	  	'btn_color' => 'btn-danger'
  	])

  	@include('gmvv_requests/partials/files_modal', [
  		'modal_id' => 'files',
		])
  </div>

@endsection

@section('js')

	<script src="{{ asset('js/gmvv_request/search.js') }}"></script>
	<script src="{{ asset('js/gmvv_request/delete_confirm.js') }}"></script>
	<script src="{{asset('js/gmvv_request/set_file_data.js')}}"></script>

@endsection