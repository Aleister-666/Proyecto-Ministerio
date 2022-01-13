<div class="py-4 text-center">
  <h2>{{$form_title}}</h2>
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

      <form action="{{$form_action}}" method="POST" enctype="multipart/form-data" id="formulario">

      	@if ($form_method == "PUT")
      		@method('PUT')
      	@endif
      	@csrf
      	
        <div class="row g-3">

          <section id="cliente" class="row">
				  	@include('gmvv_requests/partials/client_fields')
          </section>

          <hr class="my-4">

          <section id="documentos" class="row g-3">
						@include('gmvv_requests/partials/documents_fields')
          </section>

          <hr class="my-4">
          <input type="submit" class="w-100 btn btn-danger btn-lg" value="{{$form_method == 'PUT' ? 'Actualizar Registro' : 'Crear Registro'}}">
        </div>
      </form>

		</section>
		
		@include('commons/spinner_form')
  </div>
</div>	