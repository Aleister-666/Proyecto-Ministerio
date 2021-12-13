@extends('layout/workplace_layout')

@section('active-6')
	active
@endsection

@section('title')
	Solicitud para la Gran Mision Vivienda Venezuela
@endsection

@section('main_content')

	<div class="py-4 text-center">
	    <h2>Requerimientos de la solicitud</h2>
	  </div>

	  <div class="row g-5 justify-content-center">

	  	<div class="col-md-7 col-lg-8 position-relative">

	  		<section id="mensajes">

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
	  			
	  		</section>

	  		<section id="form">

		      <form action="{{route('create_gmvv_request_path')}}" method="POST" enctype="multipart/form-data" id="formulario">

		      	@csrf
		      	
		        <div class="row g-3">

		        	<h4 class="mb-3">Datos del cliente</h4>

		        	<section id="cliente" class="row">
		        		<div class="col-sm-6">
		        		  <label for="first_name" class="form-label">Primer Nombre</label>
		        		  <input type="text" name="first_name" class="form-control" placeholder="Jhonatan" value="{{old('first_name')}}">
		        		  @error('first_name')
		        		  	<div class="text-danger w-100">
		        		  	  {{$message}}
		        		  	</div>
		        		  @enderror
		        		</div>

		        		<div class="col-sm-6">
		        		  <label for="second_name" class="form-label">Segundo Nombre <span class="text-muted">(Opcional)</span></label>
		        		  <input type="text" name="second_name" class="form-control" placeholder="Jose" value="{{old('second_name')}}">
		        		  @error('second_name')
		        		  	<div class="text-danger w-100">
		        		  	  {{$message}}
		        		  	</div>
		        		  @enderror
		        		</div>

		        		<div class="col-sm-6">
		        		  <label for="first_surname" class="form-label">Primer Apellido</label>
		        		  <input type="text" name="first_surname" class="form-control" placeholder="Castro" value="{{old('first_surname')}}">
		        		  @error('first_surname')
		        		  	<div class="text-danger w-100">
		        		  	  {{$message}}
		        		  	</div>
		        		  @enderror
		        		</div>

		        		<div class="col-sm-6">
		        		  <label for="second_surname" class="form-label">Segundo apellido <span class="text-muted">(Opcional)</span></label>
		        		  <input type="text" name="second_surname" class="form-control" placeholder="Perez" value="{{old('second_surname')}}">
		        		  @error('second_surname')
		        		  	<div class="text-danger w-100">
		        		  	  {{$message}}
		        		  	</div>
		        		  @enderror
		        		</div>

		        		<div class="col-sm-6">
		        			<label for="cedula" class="form-label">Cedula de Identidad</label>
		        			<div class="input-group">
	                  <span class="input-group-text user-select-none">V</span>
			        			<input type="text" name="cedula" class="form-control" placeholder="Cedula de Identidad" value="{{old('cedula')}}">
	                </div>
		        			@error('cedula')
		        		  	<div class="text-danger w-100">
		        		  	  {{$message}}
		        		  	</div>
		        		  @enderror
		        		</div>

		        		<div class="col-sm-6">
		        			<label for="email" class="form-label">Correo Electronico</label>
		        			<input type="email" name="email" class="form-control" placeholder="tucorreo@gmail.com" value="{{old('email')}}">
		        			@error('email')
		        		  	<div class="text-danger w-100">
		        		  	  {{$message}}
		        		  	</div>
		        		  @enderror
		        		</div>

		        		<div class="col-sm-6">
		        			<label for="telefono" class="form-label">Numero de Telefono <span class="text-muted">(Opcional)</span></label>
		        			<input type="text" name="telefono" class="form-control" placeholder="04121234567" value="{{old('telefono')}}">
		        			@error('second_surname')
		        		  	<div class="text-danger w-100">
		        		  	  {{$message}}
		        		  	</div>
		        		  @enderror
		        		</div>


		        		<div class="col-sm-6">
		        		  <label for="sex" class="form-label">Sexo</label>
		        		  <select name="sex" class="form-select">
		        		  	<option value="hombre" selected>Hombre</option>
		        		  	<option value="mujer">Mujer</option>
		        		  </select>
		        		  @error('sex')
		        		  	<div class="text-danger w-100">
		        		  	  {{$message}}
		        		  	</div>
		        		  @enderror
		        		</div>

		        	</section>

		          <hr class="my-4">

		        	<h4 class="mb-3">Documentos del cliente</h4>

		          <section id="documentos" class="row g-3">
		          	<div class="col-12">
		          	  <label for="copy_ci" class="form-label">Copias de la cedula de identidad</label>
		          	  <input type="file" name="copy_ci" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
		          	  @error('copy_ci')
		          	  	<div class="text-danger w-100">
		          	  	  {{$message}}
		          	  	</div>
		          	  @enderror
		          	</div>

		          	<div class="col-12">
		          	  <label for="contancy_job" class="form-label">Constancia de Trabajo</label>
		          	  <input type="file" name="contancy_job" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
		          	  @error('contancy_job')
		          	  	<div class="text-danger w-100">
		          	  	  {{$message}}
		          	  	</div>
		          	  @enderror
		          	</div>

		          	<div class="col-12">
		          	  <label for="contancy_home" class="form-label">Constancia de Residencia</label>
		          	  <input type="file" name="contancy_home" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
		          	  @error('contancy_home')
		          	  	<div class="text-danger w-100">
		          	  	  {{$message}}
		          	  	</div>
		          	  @enderror
		          	</div>

		          	<div class="col-12">
		          	  <label for="contancy_civil" class="form-label">Constancia de Matrimonio, Solteria...</label>
		          	  <input type="file" name="contancy_civil" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
		          	  @error('contancy_civil')
		          	  	<div class="text-danger w-100">
		          	  	  {{$message}}
		          	  	</div>
		          	  @enderror
		          	</div>

		          	<div class="col-12">
		          	  <label for="birth_certificate_children" class="form-label">Partidas de nacimientos de hijos menores</label>
		          	  <input type="file" name="birth_certificate_children" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
		          	  @error('birth_certificate_children')
		          	  	<div class="text-danger w-100">
		          	  	  {{$message}}
		          	  	</div>
		          	  @enderror
		          	</div>

		          	<div class="col-12">
		          	  <label for="sworn_declaration" class="form-label">Declaracion jurada de no poseer vivienda</label>
		          	  <input type="file" name="sworn_declaration" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
		          	  @error('sworn_declaration')
		          	  	<div class="text-danger w-100">
		          	  	  {{$message}}
		          	  	</div>
		          	  @enderror
		          	</div>

		          	<div class="col-12">
		          	  <label for="registration_form_gmvv" class="form-label">Planilla de inscripcion de Gran Mision Vivienda Venezuela</label>
		          	  <input type="file" name="registration_form_gmvv" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
		          	  @error('registration_form_gmvv')
		          	  	<div class="text-danger w-100">
		          	  	  {{$message}}
		          	  	</div>
		          	  @enderror
		          	</div>

		          	<div class="col-12">
		          	  <label for="explanatory_statement" class="form-label">Exposicion de Motivos</label>
		          	  <input type="file" name="explanatory_statement" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
		          	  @error('explanatory_statement')
		          	  	<div class="text-danger w-100">
		          	  	  {{$message}}
		          	  	</div>
		          	  @enderror
		          	</div>
		          </section>

		          <hr class="my-4">

		          <input type="submit" class="w-100 btn btn-danger btn-lg" value="Registrar">

		        </div>
		      </form>

	  		</section>
	  		
	  		@include('commons/spinner_form')
	    </div>
	  </div>	
@endsection

@section('js')
	<script src="{{asset('js/common/disabled_form.js')}}"></script>

@endsection