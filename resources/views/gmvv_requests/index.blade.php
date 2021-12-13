@extends('layout/workplace_layout')

@section('active-5')
	active
@endsection

@section('title')
	Reportes de Solicitudes para la Gran Mision Vivienda Venezuela
@endsection

@section('main_content')

	<div class="my-4">
		<input type="text" id="search" name="cedula" placeholder="Cedula a buscar..." class="form-control" autocomplete="off">

		<div id="spinner" class="visually-hidden">
			<div class="spinner-border text-primary" role="status">
			  <span class="visually-hidden">Loading...</span>
			</div>
		</div>

		<div id="results" class="my-4"></div>
	</div>

	<div id="table" class="table-responsive">
	  <table class="table table-striped table-hover table-sm">
	    <thead>
	      <tr>
	        <th scope="col">Cedula</th>
	        <th scope="col">Nombres</th>
	        <th scope="col">Apellidos</th>
	        <th scope="col">Correo Electronico</th>
	        <th scope="col">Telefono</th>
	        <th scope="col">Acciones</th>
	      </tr>
	    </thead>
	    <tbody>
	      @foreach ($clients as $client)

	      	<tr>
	      		<td>{{$client->cedula}}</td>
	      		<td>{{$client->names->first_name . " " . $client->names->second_name}}</td>
	      		<td>{{$client->names->first_surname . " " . $client->names->second_surname}}</td>
	      		<td>{{$client->email}}</td>
	      		<td>{{$client->telefono ? $client->telefono : 'Sin Telefono'}}</td>

	      		<td>
	      			<div class="btn-group" role="group" aria-label="Basic outlined example">
	      			  <a href="{{route('download_gmvv_request_path', $client->id)}}" type="button" class="btn btn-outline-primary" title="Descargar Archivos de Solicitud">
	      			  	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
	      			  	  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"></path>
	      			  	</svg>
	      			  </a>

	      			  <form action="{{route('destroy_gmvv_request_path', $client->id)}}" method="POST" class="btn-group">
	      			  	@csrf
	      			  	@method('DELETE')

	      			  	<button type="submit" class="btn btn-outline-danger" title="Eliminar Solicitud">
	      			  		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
	      			  		  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
	      			  		</svg>
	      			  	</button>

	      			  </form>

	      			</div>
	      		</td>
	      	</tr>

	      @endforeach
	    </tbody>
	  </table>
	  {{$clients->links()}}
	</div>

@endsection

@section('js')

	<script>

		const d = document;

		d.addEventListener('DOMContentLoaded', () => {

			d.getElementById('search').addEventListener('keyup', () => {
				let cedula = d.getElementById('search').value.trim();	
				if (cedula.length >= 1) {
					d.getElementById('spinner').classList.remove('visually-hidden');
					url = `{{route('search_gmvv_request_path')}}?cedula=${cedula}`;

					fetch(url)
					.then(res => res.text())
					.then(html => {
						d.getElementById('results').innerHTML = html;
						d.getElementById('spinner').classList.add('visually-hidden');

					})
					.catch(err => alert(err))
				} else {
					d.getElementById('spinner').classList.add('visually-hidden');
					d.getElementById('results').innerHTML = '';
				}
			})
		})

	</script>

@endsection