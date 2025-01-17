<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ministerio del Poder Popular para Habitat y Vivienda</title>	
	<link rel="stylesheet" href="{{ asset('css/index.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	<link rel="icon" href="{{asset('images/sessions/logo GMVV(30x30).png')}}" type="image/png">
	@yield('extra_css')
</head>
<body>
	@yield('content')

	<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>