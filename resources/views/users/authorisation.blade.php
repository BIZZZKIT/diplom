<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
        background-color: #1a1a1a;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        font-family: 'Montserrat', sans-serif;
        color: white;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 32px rgba(255, 195, 0, 0.2);
    }

    .login-card h1 {
        font-size: 1.8rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 1.5rem;
        color: #FFC300;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        font-size: 0.9rem;
        font-weight: 500;
        color: #ddd;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        background-color: #333;
        border: 1px solid #555;
        border-radius: 8px;
        color: white;
        padding: 0.75rem;
        font-size: 0.95rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 10px #FFC300;
        border-color: #FFC300;
        outline: none;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        font-size: 0.85rem;
        color: #dc3545;
        margin-top: 0.25rem;
    }

    .alert-danger {
        background-color: #dc3545;
        color: white;
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 1.25rem;
        font-size: 0.9rem;
        text-align: center;
    }

    .btn-login {
        width: 100%;
        background-color: #FFC300;
        color: black;
        border: none;
        border-radius: 8px;
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        font-family: 'Montserrat', sans-serif;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-login:hover {
        background-color: #FFD700;
        transform: translateY(-2px);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    @media (max-width: 576px) {
        .login-card {
            padding: 1.5rem;
            margin: 0 1rem;
        }

        .login-card h1 {
            font-size: 1.5rem;
        }
    }
</style>

@extends('welcome')
@section('title', 'Авторизация')
@section('content')
    <div class="login-container">
        <div class="login-card">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Авторизация</h1>
                @if($errors->has('error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('error') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn-login">Войти</button>
            </form>
        </div>
    </div>
@endsection
