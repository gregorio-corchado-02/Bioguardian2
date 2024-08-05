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
                {{ __('Register') }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    body {
        background-image: url('https://wallpapers.com/images/hd/green-tree-background-g7328hzf8ua9k39t.jpg');
        font-family: 'Roboto', sans-serif;
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
        background-size: cover;
        background-position: center;
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
        padding-top: 38%;
        object-fit: cover;
        background: none;
        box-shadow: none;
    }
    .login-header {
        text-align: center;
        font-size: 2rem;
        color: #007bff;
        margin-bottom: 20px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }
    .login-title {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 10px;
        font-family: 'Arial', sans-serif;
        font-size: 1.5em;
        color: #333;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        letter-spacing: 0.5px;
    }
</style>

