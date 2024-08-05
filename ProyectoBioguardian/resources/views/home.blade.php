@extends('layouts.app')

@section('content')

<style>
.navbar {
    background-color: #28a745;
    margin-bottom: 0; /* Elimina margen inferior del navbar */
}

.navbar-brand img {
    width: 46px;
    border-radius: 50%;
}

body {
    font-family: 'Roboto', sans-serif;
    background-size: cover;
    background-position: center;
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem; /* Espacio entre las cards */
}

.card {
    flex: 1 1 calc(33.3333% - 1rem); /* Ajusta el ancho de las cards y el espacio entre ellas */
    max-width: calc(33.3333% - 1rem); /* Asegura que no se desborden */
}

.card img {
    width: 100%;
    height: 200px; /* Ajusta la altura según tus necesidades */
    object-fit: cover; /* Mantiene la proporción de aspecto y recorta la imagen si es necesario */
}

.card-body h5 {
  text-align: center;
  font-size: 2rem;
  color: red;
  margin-bottom: 10px;
  font-weight: 700; /* Hace el texto más grueso */ /* Convierte el texto a mayúsculas */
  letter-spacing: 0.5px; /* Añade espacio entre las letras */
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}



.button-container {
    position: absolute;
    bottom: 10px;
    right: 10px;
}

.carousel {
    height: 700px; /* Ajusta la altura del carrusel */
}

.carousel-inner {
    height: 100%; /* Asegura que las imágenes ocupen toda la altura del carrusel */
}

.carousel-inner img {
    width: 100%;
    height: 100%; /* Asegura que las imágenes ocupen toda la altura del carrusel */
    object-fit: cover; /* Mantiene la proporción de aspecto y recorta la imagen si es necesario */
}

.carousel-caption {
    position: absolute;
    bottom: 13%;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.carousel-caption h1,
.carousel-caption h5 {
    font-size: 2rem;
    font-weight: bold;
}



.carousel-caption p {
    font-size: 1rem;
}
</style>

<div id="carouselExampleInterval" class="carousel slide mb-5" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="https://nortempo.com/wp-content/uploads/2023_06_05_dia-del-medio-ambiente.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="text-white">BioGuardian</h1>
        <p>Conéctate, Inspira y Protege: Juntos por la Vida Salvaje.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="https://www.ngenespanol.com/wp-content/uploads/2022/12/jaguar-el-enorme-y-mitico-felino-de-america-que-continua-sobreviviendo.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Protección</h5>
        <p>BioGuardian permite a los usuarios conectar, inspirar y proteger la vida silvestre.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://megino.com/wp-content/uploads/2020/04/medio-ambiente.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Medio Ambiente</h5>
        <p>Con BioGuardian, los usuarios pueden documentar y compartir avistamientos de especies en peligro, fomentar la conciencia ambiental y unirse en la protección de la biodiversidad.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<h1 class="display-1 text-dark text-center">Publicación</h1>

<div class='container mt-3'>
  <div class="card-container">
  @foreach ($publicaciones as $item)
  <div class="card mb-3">
    <img src="{{ asset('storage/' . $item->foto_publi) }}" class="card-img-top" alt="...">
    <div class="card-body text-center">
      <h5 class="card-title">{{ $item->titulo }}</h5>
      <small class="text-muted">{{ $item->fecha }}</small>
      <p class="card-text fs-5">{{ $item->comentario }}</p>
    </div>
    <div class="card-footer mt-auto">
      @if (Auth::user()->id === $item->id_usuario || Auth::user()->role === 'admin')
        <div class='mb-2 d-grid mx-auto'>
            <button type='button' class='btn btn-outline-success' data-bs-target='#editar{{ $item->id }}' data-bs-toggle='modal'>
                Editar
            </button>
        </div>
        <div class='mb-2 d-grid mx-auto'>
            <button type='button' class='btn btn-outline-success' data-bs-target='#eliminar{{ $item->id }}' data-bs-toggle='modal'>
                Eliminar
            </button>
        </div>
      @endif
    </div>
  </div>
  @endforeach


    
  </div>

  @foreach ($publicaciones as $item)
    @include('partials.editpubli')
    @include('partials.elipubli')
  @endforeach

</div>

@if(session()->has('confirmacion'))
    <script>
            Swal.fire({
            title: 'Confirmación',
            text: '{{ session('confirmacion') }}',
            icon: 'success',
            confirmButtonText: 'Ok'
        });
    </script>
@endif

@endsection

