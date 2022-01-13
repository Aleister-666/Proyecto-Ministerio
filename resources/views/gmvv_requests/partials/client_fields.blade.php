<h4 class="mb-3">Datos del cliente</h4>


@if ($form_method == "PUT")

  <div class="mb-4">
    <label for="state_id" class="form-label">Estado de la Solicitud</label>
    <select name="state_id" class="form-select">
      @foreach ($states as $state)
        @if ($gmvv_request->task->state_id == $state->id)
          <option value="{{$state->id}}" selected>{{$state->name}}</option>        
        @else
          <option value="{{$state->id}}">{{$state->name}}</option>        

        @endif
      @endforeach
    </select>
    @error('state_id')
      <div class="text-danger w-100">
        {{$message}}
      </div>
    @enderror
    
  </div>

@endif

<div class="col-sm-6">
  <label for="first_name" class="form-label">Primer Nombre</label>
  <input type="text" name="first_name" class="form-control" placeholder="{{$first_name ? $first_name : 'Pedro'}}" value="{{old('first_name', $first_name)}}">
  @error('first_name')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-sm-6">
  <label for="second_name" class="form-label">Segundo Nombre <span class="text-muted">(Opcional)</span></label>
  <input type="text" name="second_name" class="form-control" placeholder="{{$second_name ? $second_name : 'Juan'}}" value="{{old('second_name', $second_name)}}">
  @error('second_name')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-sm-6">
  <label for="first_surname" class="form-label">Primer Apellido</label>
  <input type="text" name="first_surname" class="form-control" placeholder="{{$first_surname ? $first_surname : 'Castro'}}" value="{{old('first_surname', $first_surname)}}">
  @error('first_surname')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-sm-6">
  <label for="second_surname" class="form-label">Segundo apellido <span class="text-muted">(Opcional)</span></label>
  <input type="text" name="second_surname" class="form-control" placeholder="{{$second_surname ? $second_surname : 'Perez'}}" value="{{old('second_surname', $second_surname)}}">
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
		<input type="text" name="cedula" class="form-control" placeholder="{{$cedula ? $cedula : 'Cedula de Identidad'}}" value="{{old('cedula', $cedula)}}">
  </div>
	@error('cedula')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-sm-6">
	<label for="email" class="form-label">Correo Electronico</label>
	<input type="email" name="email" class="form-control" placeholder="{{$email ? $email : 'tucorreo@dominio.com'}}" value="{{old('email', $email)}}">
	@error('email')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-sm-6">
	<label for="telefono" class="form-label">Numero de Telefono <span class="text-muted">(Opcional)</span></label>
	<input type="text" name="telefono" class="form-control" placeholder="{{$telefono}}" value="{{old('telefono', $telefono)}}">
	@error('second_surname')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>

<div class="col-sm-6">
  <label for="sex" class="form-label">Sexo</label>
  <select name="sex" class="form-select">

  	@if ($form_method == "PUT")
  		<option value="{{strtolower($sex)}}" selected>{{$sex}}</option>
  	@else
  		<option value="hombre" selected>Hombre</option>
  		<option value="mujer">Mujer</option>
  	@endif
  </select>
  @error('sex')
  	<div class="text-danger w-100">
  	  {{$message}}
  	</div>
  @enderror
</div>