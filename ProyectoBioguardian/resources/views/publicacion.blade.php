@extends('layouts.app')

@section('content')

<style>
body {
    font-family: 'Roboto', sans-serif; /* Aplica la fuente Roboto al cuerpo del documento */
    background-image: url('https://wallpapercave.com/wp/wp2531406.jpg');
    background-size: cover;
    background-position: center;
}

.navbar {
    background-color: #28a745;            
}

.navbar-brand img {
    width: 46px;
    border-radius: 50%;
}

.login-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.login-card {
    width: 100%;
    max-width: 800px;
    background: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-image {
    
    object-fit: cover;
    display: block;
    margin: 0 auto; /* Centra horizontalmente la imagen */
    padding-top: 35%;
    background: none;
    box-shadow: none;
    
}

.login-header {
    font-family: 'Arial', sans-serif;
    text-align: center;
    font-size: 2rem;
    color: #007bff;
    margin-bottom: 20px;
    font-weight: 700; /* Hace el texto más grueso */ /* Convierte el texto a mayúsculas */
    letter-spacing: 0.5px; /* Añade espacio entre las letras */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

.login-title {
    font-family: 'Arial', sans-serif; /* Tipografía */
    font-size: 1.5em; /* Tamaño de fuente */
    color: #333; /* Color del texto */
    text-align: center; /* Alineación */
    margin-top: 20px; /* Espaciado superior */
    margin-bottom: 20px; /* Espaciado inferior */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* Sombra del texto */
    letter-spacing: 0.5px; /* Espaciado entre letras */
}

</style>

<div class="login-container">
    <div class="login-card row">
        <div class="col-md-5 text-center">
            <img src="{{ asset('logo.png') }}" alt="BIOGUARDIAN" width="150" class="login-image mt-4">
            <h1 class="login-title mt-4">BIOGUARDIAN</h1>
        </div>
        <div class="col-md-7">
            <div class="login-header">
                Crear Publicación
            </div>
            <div class="card-body">
            <form method="POST" action="/guardarpublicacion" enctype="multipart/form-data">
                @csrf
                <!-- Campos del formulario -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}">
                    @error('titulo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="comentarios" class="form-label">Comentarios</label>
                    <div class="form-floating">
                        <textarea class="form-control @error('comentarios') is-invalid @enderror" name="comentarios" id="comentarios" placeholder="Escribe tus comentarios aquí" style="height: 100px">{{ old('comentarios') }}</textarea>
                        <label for="comentarios">Escribe tus comentarios aquí</label>
                        @error('comentarios')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Seleccionar foto</label>
                    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                    @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid mb-4">
                    <button class="btn btn-success" type="submit">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
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
