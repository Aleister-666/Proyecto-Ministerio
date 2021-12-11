<!DOCTYPE html>
<html lang="es" class="">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ministerio del Poder Popular para Habitat y Vivienda</title>	
	<link rel="stylesheet" href="{{ asset('css/index.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{asset('css/workplace/dashboard.css')}}">
	@yield('extra_css')
</head>
<body class="">

		<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
		  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{route('root_path')}}">{{$user->departament->name}}</a>
		  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
		  <div class="navbar-nav">
		    <div class="nav-item text-nowrap">
		      <a class="nav-link px-3" href="{{route('logout_path')}}">Cerrar Session</a>
		    </div>
		  </div>
		</header>

		<div class="container-fluid">
	  <div class="row">
	    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse overflow-scroll">
	      <div class="position-sticky pt-3">
	        <ul class="nav flex-column">
	          <li class="nav-item">
	            <a class="nav-link @yield('active-1')" aria-current="page" href="{{route('workplace_path')}}">
	              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
	              Dashboard
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link @yield('active-2')" href="#">
	              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file" aria-hidden="true"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
	              Documentos
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link @yield('active-3')" href="#">
	              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
	              Products
	            </a>
	          </li>
	          <li class="nav-item">
	          	<div class="dropdown">
	          		<a type="button" id="dropdown-menu-user" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle @yield('active-4')">
	          			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
	          			Usuario
	          		</a>
	          		<ul aria-labelledby="dropdown-menu-user" class="dropdown-menu">
	          			<li>
	          				@if (auth()->user()->hasRole(['admin', 'coordinator']))
		          				<a href="{{route('new_user_path')}}" class="dropdown-item">Crear Nuevo Usuario</a>
	          				@endif
	          				<a href="{{route('edit_user_path')}}" class="dropdown-item">Actualizar Mis Datos</a>
	          			</li>
	          		</ul>
	          	</div>
	          </li>

	          <li class="nav-item">

	            <div class="dropdown">
	          		<a type="button" id="dropdown-menu-reports" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle @yield('active-5')">
	          			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2" aria-hidden="true"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
	          			Reportes
	          		</a>

	          		@if ($user->departament->name == 'Redes Populares')	
	          				<ul aria-labelledby="dropdown-menu-task" class="dropdown-menu">
	          					<li>
	          						<a href="{{route('index_gmvv_request_path')}}" class="dropdown-item">GMVV</a>
	          					</li>
	          				</ul>
	          		@endif

	          	</div>

	          </li>

	          <li class="nav-item">

	            <div class="dropdown">
	          		<a type="button" id="dropdown-menu-task" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle @yield('active-6')">
	          			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers" aria-hidden="true"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
	          			Tareas
	          		</a>

	          		@if ($user->departament->name == 'Redes Populares')	
	          				<ul aria-labelledby="dropdown-menu-task" class="dropdown-menu">
	          					<li>
	          						<a href="{{route('new_gmvv_request_path')}}" class="dropdown-item">Registro GMVV</a>
	          					</li>
	          				</ul>
	          		@endif

        			</div>

	          </li>
	        </ul>

	        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>MAS OPCIONES(COMING SOON)</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>

	      </div>
	    </nav>

	    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
	      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	        <h1 class="h2">@yield('title')</h1>
	      </div>

	      @yield('main_content')
	    </main>
	  </div>
	</div>

	<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>