@extends('layouts.navbar')

@section('content')
<div class="login-container">
    <div class="login-card row">
        <div class="col-md-5 text-center">
            <img src="{{ asset('logo.png') }}" alt="BIOGUARDIAN" width="150" class="login-image mt-4">
            <h1 class="login-title mt-4">BIOGUARDIAN</h1>
        </div>
        <div class="col-md-7">
            <div class="login-header">
                {{ __('Login') }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Login') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>

    body {
        background-image: url('https://static.vecteezy.com/system/resources/previews/025/870/841/non_2x/green-nature-on-blur-backgroud-beautiful-nature-as-spring-wallpaper-generative-ai-free-photo.jpeg');
        font-family: 'Roboto', sans-serif;
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
        background-size: cover;
        background-position: center;
    }
    .login-card {
        width: 100%;
        max-width: 800px;
        background: rgba(255, 255, 255, 0.9);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .login-image {
        object-fit: cover;
        padding-top: 20%;
        background: none;
        box-shadow: none;
    
    }

    .login-header {
        text-align: center;
        font-size: 2rem;
        color: #007bff;
        margin-bottom: 20px;
        font-weight: 700; /* Hace el texto más grueso */ /* Convierte el texto a mayúsculas */
        letter-spacing: 0.5px; /* Añade espacio entre las letras */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }
    .login-title {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 10px;
        font-family: 'Arial', sans-serif; /* Tipografía */
        font-size: 1.5em; /* Tamaño de fuente */
        color: #333; /* Color del texto */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Sombra del texto */
        letter-spacing: 0.5px; /* Espaciado entre letras */
    }
</style>
