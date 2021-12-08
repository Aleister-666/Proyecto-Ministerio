<div class="container">
	<form action="{{route($action_form, $action_form_parameter)}}" method="POST" enctype="multipart/form-data">

		@if ($method_form)
			@method($method_form)
		@endif
		
		@csrf

		<div class="row-row-g3">

			@if ($message = Session::get('success'))
				<div class="alert alert-success">
					{{$message}}
				</div>
			@endif

			<div class="col-12">
				<label for="title" class="form-label">Titulo</label>
				<input type="text" name="title" value="{{old('title', $title_value)}}" class="form-control" placeholder="Titulo del Documento">
			</div>
			@error('title')
				<div class="alert alert-danger">
					{{$message}}
				</div>
			@enderror

			<div class="col-12">
				<label for="description" class="form-label">Descripcion <span class="text-muted">(Opcional)</span></label>
				<textarea name="description" cols="30" rows="10" class="form-control" placeholder="Descripcion del Documento">{{old('description', $description_value)}}</textarea>
			</div>
			@error('description')
				<div class="alert alert-danger">
					{{$message}}
				</div>
			@enderror

			<div class="col-12">
				<input type="file" name="file" class="form-label" accept=".pdf, .doc, .docx, .pptx, .xlsx">
				<label for="file">Selecciona un Documento</label>
			</div>
			@error('file')
				<div class="alert alert-danger">
					{{$message}}
				</div>
			@enderror

			<input type="submit" name="submit" class="btn btn-danger btn-block mt-4" value="{{$submit_value}}">
		</div>

	</form>
</div>

<script src="{{asset('js/common/disabled_form.js')}}">
</script>