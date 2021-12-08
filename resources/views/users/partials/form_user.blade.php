<div class="container">
  <main>
    <div class="py-4 text-center">
      <h2>{{$title_action}}</h2>
      {{-- <p class="lead">Introduzca sus datos</p> --}}
    </div>


    <div class="row g-5 justify-content-center">

    	<div class="col-md-7 col-lg-8 w-100">

        @if ($message = Session::get('success'))
          <div class="alert alert-success">
            {{$message}}
          </div>
        @else
          <h4 class="mb-3">{{$title_form}}</h4>
        @endif

        <form action="{{route($form_action)}}" method="POST">

          @if ($form_method == 'PUT')
            @method('PUT')
          @endif

        	@csrf
        	
          <div class="row g-3">

            <div class="col-sm-6">
              <label for="first_name" class="form-label">Primer Nombre</label>
              <input type="text" name="first_name" class="form-control" placeholder="{{$first_name_value ? $first_name_value : 'Pablo'}}" value="{{old('first_name', $first_name_value)}}">
              @error('first_name')
              	<div class="text-danger w-100">
              	  {{$message}}
              	</div>
              @enderror
            </div>

            <div class="col-sm-6">
              <label for="second_name" class="form-label">Segundo Nombre <span class="text-muted">(Opcional)</span></label>
              <input type="text" name="second_name" class="form-control" placeholder="{{$second_name_value ? $second_name_value : 'Jose'}}" value="{{old('second_name', $second_name_value)}}">
              @error('second_name')
              	<div class="text-danger w-100">
              	  {{$message}}
              	</div>
              @enderror
            </div>

            <div class="col-sm-6">
              <label for="first_surname" class="form-label">Primer Apellido</label>
              <input type="text" name="first_surname" class="form-control" placeholder="{{$first_surname_value ? $first_surname_value : 'Bolivar'}}" value="{{old('first_surname', $first_surname_value)}}">
              @error('first_surname')
              	<div class="text-danger w-100">
              	  {{$message}}
              	</div>
              @enderror
            </div>

            <div class="col-sm-6">
              <label for="second_surname" class="form-label">Segundo apellido <span class="text-muted">(Opcional)</span></label>
              <input type="text" name="second_surname" class="form-control" placeholder="{{$second_surname_value ? $second_surname_value : 'Palacios'}}" value="{{old('second_surname', $second_surname_value)}}">
              @error('second_surname')
              	<div class="text-danger w-100">
              	  {{$message}}
              	</div>
              @enderror
            </div>

            @if (auth()->user()->hasRole(['admin', 'coordinator']))

	            <div class="col-sm-6">
                <label for="departament" class="form-label">Departamento de trabajo</label>
              	<select class="form-select" name="departament" aria-label="Default select example">
              	  <option value="" selected>Selecciona un departamento de trabajo</option>
	              	  @foreach($departaments as $departament)
	  	            	  <option value="{{$departament->id}}">{{$departament->name}}</option>
	              	  @endforeach
              	</select>
              	@error('departament')
              		<div class="text-danger w-100">
              		  {{$message}}
              		</div>
              	@enderror
              </div>

              <div class="col-sm-6">
                <label for="role" class="form-label">Cargo de Trabajo</label>
              	<select class="form-select" name="role" aria-label="Default select example">
              	  <option value="" selected>Selecciona un cargo para este usuario</option>
	              	  @foreach($roles as $role)
	  	            	  <option value="{{$role->id}}">{{$role->name}}</option>
	              	  @endforeach
              	</select>

              	@error('role')
              		<div class="text-danger w-100">
              		  {{$message}}
              		</div>
              	@enderror
              </div>

              <div class="col-sm-6">
                <label for="cedula" class="form-label">Cedula</label>
                <div class="input-group">
                  <span class="input-group-text user-select-none">V</span>
                  @if ($form_method == 'PUT')
                    <input type="text" name="cedula" class="form-control" placeholder="{{$cedula_value ? $cedula_value : 'Cedula de Identidad'}}" value="{{old('cedula', $cedula_value)}}" readonly>
                  @else
                    <input type="text" name="cedula" class="form-control" placeholder="{{$cedula_value ? $cedula_value : 'Cedula de Identidad'}}" value="{{old('cedula', $cedula_value)}}">
                  @endif
                </div>
                @error('cedula')
                	<div class="text-danger w-100 ">
                	  {{$message}}
                	</div>
                @enderror
              </div>

            @endif

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

            <div class="col-sm-6">
              <label for="email" class="form-label">Correo Electronico</label>
              <input type="email" name="email" class="form-control" placeholder="{{$email_value ? $email_value : 'tucorreo@ejemplo.com'}}" value="{{old('email', $email_value)}}">
              @error('email')
              	<div class="text-danger w-100">
              	  {{$message}}
              	</div>
              @enderror
            </div>

            <div class="col-sm-6">
              <label for="telefono" class="form-label">Telefono</label>
              <input type="tel" name="telefono" class="form-control" placeholder="{{$telefono_value ? $telefono_value : ''}}" value="{{old('telefono', $telefono_value)}}">
              @error('telefono')
              	<div class="text-danger w-100">
              	  {{$message}}
              	</div>
              @enderror
            </div>

            <div class="col-sm-6">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" name="password" class="form-control">
              @error('password')
              	<div class="text-danger w-100">
              	  {{$message}}
              	</div>
              @enderror
            </div>

            <div class="col-sm-6">
              <label for="password_confirmation" class="form-label">Confirmacion de Contraseña</label>
              <input type="password" name="password_confirmation" class="form-control">
              @error('password_confirmation')
              	<div class="text-danger w-100">
              	  {{$message}}
              	</div>
              @enderror
            </div>
          </div>

          <hr class="my-4">

          <input type="submit" class="w-100 btn btn-danger btn-lg" value="{{$submit_value}}">
        </form>
    
    </div>

  </main>

{{--   <footer class="my-5 text-muted text-center text-small">
    <p class="mb-1">Ministerio del Poder Popular para Habitat y Vivienda</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="{{route('root_path')}}">Pagina de Inicio</a></li>
      <li class="list-inline-item"><a href="{{route('workplace_path')}}">Area de Trabajo</a></li>
    </ul>
  </footer> --}}

</div>

<script src="{{asset('js/common/disabled_form.js')}}"></script>