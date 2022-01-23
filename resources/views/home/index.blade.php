@extends('layout/application')

@section('extra_css')
	<link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
@endsection

@section('content')

	<header class="header">
		<div>
			<img src="{{asset('images/home/baner-gobierno2(rojo).png')}}" alt="Banner Ministerio">
		</div>
	</header>

	<section id="objetive">
		<div class="image-box-objetive">
			<img src="{{asset('images/home/GMVV02.jpg')}}" alt="Vivienda VNZ">
			<div class="text-box-objetive">
				<h1>Nuestro Objetivo</h1>
				<p>"Garantizar que las familias de Venezuela dispongan de un lugar digno donde poder vivir, desarrollarse y crecer de manera apropiada para poder diseñar y crear todos juntos una sociedad"</p>
			</div>
		</div>
	</section>

	<section id="navbar" class="sticky-top">
		<nav class="navbar navbar-expand-lg navbar-dark bg-red-dark">
			<div class="container-fluid">

				@if (auth()->check())
					<span class="navbar-brand">{{auth()->user()->names->first_name . ' ' . auth()->user()->names->first_surname}}</span>
				@else
					<span class="navbar-brand"></span>
				@endif

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div id="navbarNav" class="collapse navbar-collapse">
					<ul class="navbar-nav me-auto">
						<li class="nav-item">
							<a href="#notices" class="nav-link" title="Noticias">Noticias</a>
						</li>

						<li class="nav-item">
							<a href="#mision" class="nav-link" title="Nuestra Mision">Mision</a>
						</li>
						<li class="nav-item">
							<a href="#vision" class="nav-link" title="Nuestra Vision">Vision</a>
						</li>
						<li class="nav-item">
							<a href="#objetives-ministerio" class="nav-link" title="Nuestras Labores">Labores</a>
						</li>
					</ul>

					<div class="d-flex">
						@if (auth()->check())
							<a href="{{route('workplace_path')}}" class="btn btn-outline-light me-2">Area de Trabajo</a>
							<a href="{{route('logout_path')}}" class="btn btn-outline-light">Cerrar Session</a>
						@else
							<a href="{{route('login_path')}}" class="btn btn-outline-light me-2">Iniciar Session</a>
						@endif
					</div>
				</div>
			</div>
		</nav>
	</section>

	<section id="notices" class="container">
	{{-- 	<section id="carrusel">
			<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000">
			  <div class="carousel-indicators">
			    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
			    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
			  </div>
			  <div class="carousel-inner">
			    <div class="carousel-item active">
			      <img src="assets/images/home/construcción del urbanismo Villas de Paurario(800x445).jpg" class="d-block w-100" alt="Casas contruidas en urbanizacion Paurario" width="400px" height="400px">
			      <div class="carousel-caption d-md-block">
			        <h5>Municipio Juan German Rosio</h5>
			        <p>
			        	Gran Misión Vivienda Venezuela, consolida la construcción del urbanismo
			        	Villas de Paurario con la entrega de <strong>12 viviendas en Guárico.</strong>
			        </p>
			      </div>
			    </div>
			    <div class="carousel-item">
			      <img src="assets/images/home/culminacion vivienda.png" class="d-block w-100" alt="..." width="400px" height="400px">
			      <div class="carousel-caption d-md-block">
			        <h5>Gran Mision Vivienda Venezula</h5>
			        <p>
			        	Anuncia la culminación de la vivienda <strong>3.758.105</strong> y el Instituto Nacional de Tierras Urbanas ha conferido <strong>1.199.980</strong> documentos.
			        </p>
			      </div>
			    </div>
			    <div class="carousel-item">
			      <img src="assets/images/home/Reunion.jpg" class="d-block w-100" alt="..." width="400px" height="400px">
			      <div class="carousel-caption d-md-block">
			        <h5>Ministerio del Poder Popular de Habitat y Vivienda</h5>
			        <p>
			        	Trabajando por y para los Venezolanos.
			        </p>
			      </div>
			    </div>
			  </div>
			  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="visually-hidden">Anterior</span>
			  </button>
			  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="visually-hidden">Siguiente</span>
			  </button>
			</div>
		</section> --}}
	</section>

	<section id="cards" class="container">
		<div id="mision" class="box">
			<div class="image-box">
				<img src="{{asset('images/home/Maduro.png')}}" alt="">
			</div>
			<div class="text-box">
				<h2>Nuestra Mision</h2>
				<p class="fs-5">"Satisfacer las necesidades de vivienda, obras de urbanismo y servicios básicos de infraestructura y equipamiento integral de las áreas urbanas, sub-urbanas y rurales de la población de escasos recursos, orientados bajo una filosofía de calidad, con un personal altamente calificado, enmarcado en un liderazgo de principios y preocupado por la innovación tecnológica, impulsando el desarrollo integral de la población a través de la ejecución de obras y la satisfacción de la demanda habitacional en el marco del plan de desarrollo económico y social"</p>
			</div>
		</div>

		<div class="box">
			<div id="vision" class="image-box">
				<img src="{{asset('images/home/Ministro del poder popular para habitat y vivienda.png')}}" alt="">
			</div>
			<div class="text-box">
				<h2>Nuestra Vision</h2>
				<p class="fs-5">"Ser un organismo rector de la política habitacional, de consolidación y ordenamiento de las áreas urbanas y rurales de la población de escasos recursos del Estado, capaz de disminuir notoriamente el déficit habitacional de las familias, bajo criterios de calidad, eficiencia y ética, para contribuir con un ambiente digno donde las familias se desarrollen y puedan incorporarse al sistema productivo, contando con un equipo humano comprometido, capacitado, actualizado y orgulloso de pertenecer al instituto"</p>
			</div>
		</div>
	</section>

	<section id="objetives-ministerio">
		<div class="box-obj-minis">
			<div class="header-obj-minis">
				<h2 class="fs-1">Nuestras Labores</h2>
			</div>
			<div id="objetive-1" class="item-obj-minis obj-1">
				<div class="obj-image">
					<img src="{{asset('images/home/svg/objetive-1')}}.svg" alt="objetivo 1">
				</div>
				<div class="obj-description">
					<p>Administrar las viviendas construidas por el estado, o que estén bajo la administración especial del estado.</p>
				</div>
			</div>
			<div id="objetive-2" class="item-obj-minis obj-5">
				<div class="obj-image">
					<img src="{{asset('images/home/svg/objetive-2')}}.svg" alt="">
				</div>
				<div class="obj-description">
					<p>Adjudicar tierras pertenecientes al estado, destinados a la construcción de viviendas.</p>
				</div>
			</div>
			<div id="objetive-3" class="item-obj-minis obj-2">
				<div class="obj-image">
					<img src="{{asset('images/home/svg/objetive-3')}}.svg" alt="">
				</div>
				<div class="obj-description">
					<p>Garantizar los medios necesarios para que las familias de escasos recursos, puedan acceder a las políticas sociales y al crédito para la construcción.</p>
				</div>
			</div>
			<div id="objetive-4" class="item-obj-minis obj-4">
				<div class="obj-image">
					<img src="{{asset('images/home/svg/objetive-4')}}.svg" alt="">
				</div>
				<div class="obj-description">
					<p>Cumplir funciones relacionadas con la administración de lotes de tierras destinados a la construcción de viviendas, y a la administración de conjuntos habitacionales.</p>
				</div>
			</div>
			<div id="objetive-5" class="item-obj-minis obj-3">
				<div class="obj-image">
					<img src="{{asset('images/home/svg/objetive-5')}}.svg" alt="">
				</div>
				<div class="obj-description">
					<p>Administrar la Cartera Hipotecaria del Instituto.</p>
				</div>
			</div>
		</div>
	</section>

	<section id="banner-bottom">
		<div class="banner-bottom">
			<img src="{{asset('images/home/maduro_chave_astracto(928x276).jpg')}}" alt="banner-bottom">
		</div>
	</section>

	<footer class="footer">
		<div class="footer-image">
			<img src="{{asset('images/home/Bandera-republica.png')}}" alt="Gobierno Bolivariano de Venezuela">
		</div>
		<div class='footer-content'>
			<p>Avenida Romulo Gallegos. Edificio MINEHV. San Juan de los Morros – Estado Guárico. Código Postal 2301. Teléfono:  0246 4316406, Fax: 0246 4315862 - E-mail: inaviguarico@gmail.com</p>
		</div>	
	</footer>	
@endsection