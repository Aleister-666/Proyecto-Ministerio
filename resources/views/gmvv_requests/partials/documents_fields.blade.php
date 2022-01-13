<h4 class="mb-3">Documentos del cliente</h4>

<div class="col-12">
  <label for="copy_ci" class="form-label">
    Copias de la cedula de identidad
    @if($form_method == "PUT" && !is_null($gmvv_request->contancy_job))
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle text-warning" viewBox="0 0 16 16" title="Ya hay un archivo registrado">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
      </svg>
      <p class="d-inline m-0 text-warning">Ya existe un archivo registrado</p>
    @endif
  </label>
  <input type="file" name="copy_ci" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">

  @error('copy_ci')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-12">
  <label for="contancy_job" class="form-label">
    Constancia de Trabajo
    @if($form_method == "PUT" && !is_null($gmvv_request->contancy_job))
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle text-warning" viewBox="0 0 16 16" title="Ya hay un archivo registrado">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
      </svg>
      <p class="d-inline m-0 text-warning">Ya existe un archivo registrado</p>
    @endif
  </label>
  <input type="file" name="contancy_job" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
  @error('contancy_job')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-12">
  <label for="contancy_home" class="form-label">
    Constancia de Residencia
    @if($form_method == "PUT" && !is_null($gmvv_request->contancy_home))
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle text-warning" viewBox="0 0 16 16" title="Ya hay un archivo registrado">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
      </svg>
      <p class="d-inline m-0 text-warning">Ya existe un archivo registrado</p>
    @endif
  </label>
  <input type="file" name="contancy_home" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
  @error('contancy_home')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-12">
  <label for="contancy_civil" class="form-label">
    Constancia de Matrimonio, Solteria...
    @if($form_method == "PUT" && !is_null($gmvv_request->contancy_civil))
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle text-warning" viewBox="0 0 16 16" title="Ya hay un archivo registrado">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
      </svg>
      <p class="d-inline m-0 text-warning">Ya existe un archivo registrado</p>
    @endif
  </label>
  <input type="file" name="contancy_civil" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
  @error('contancy_civil')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-12">
  <label for="birth_certificate_children" class="form-label">
    Partidas de nacimientos de hijos menores
    @if($form_method == "PUT" && !is_null($gmvv_request->birth_certificate_children))
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle text-warning" viewBox="0 0 16 16" title="Ya hay un archivo registrado">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
      </svg>
      <p class="d-inline m-0 text-warning">Ya existe un archivo registrado</p>
    @endif
  </label>
  <input type="file" name="birth_certificate_children" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
  @error('birth_certificate_children')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-12">
  <label for="sworn_declaration" class="form-label">
    Declaracion jurada de no poseer vivienda
    @if($form_method == "PUT" && !is_null($gmvv_request->sworn_declaration))
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle text-warning" viewBox="0 0 16 16" title="Ya hay un archivo registrado">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
      </svg>
      <p class="d-inline m-0 text-warning">Ya existe un archivo registrado</p>
    @endif
  </label>
  <input type="file" name="sworn_declaration" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
  @error('sworn_declaration')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-12">
  <label for="registration_form_gmvv" class="form-label">
    Planilla de inscripcion de Gran Mision Vivienda Venezuela
    @if($form_method == "PUT" && !is_null($gmvv_request->registration_form_gmvv))
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle text-warning" viewBox="0 0 16 16" title="Ya hay un archivo registrado">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
      </svg>
      <p class="d-inline m-0 text-warning">Ya existe un archivo registrado</p>
    @endif
  </label>
  <input type="file" name="registration_form_gmvv" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
  @error('registration_form_gmvv')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-12">
  <label for="explanatory_statement" class="form-label">
    Exposicion de Motivos
    @if($form_method == "PUT" && !is_null($gmvv_request->explanatory_statement))
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle text-warning" viewBox="0 0 16 16" title="Ya hay un archivo registrado">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
      </svg>
      <p class="d-inline m-0 text-warning">Ya existe un archivo registrado</p>
    @endif
  </label>
  <input type="file" name="explanatory_statement" class="form-control" accept=".pdf, .doc, .docx, .pptx, .xlsx">
  @error('explanatory_statement')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>