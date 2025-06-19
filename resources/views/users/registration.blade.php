<style>
    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .register-card {
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

    .register-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 32px rgba(255, 195, 0, 0.2);
    }

    .register-card h1 {
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

    .btn-register {
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

    .btn-register:hover {
        background-color: #FFD700;
        transform: translateY(-2px);
    }

    .btn-register:active {
        transform: translateY(0);
    }

    @media (max-width: 576px) {
        .register-card {
            padding: 1.5rem;
            margin: 0 1rem;
        }

        .register-card h1 {
            font-size: 1.5rem;
        }
    }
</style>

@extends('welcome')
@section('title', 'Регистрация')
@section('content')
    <div class="register-container">
        <div class="register-card">
            <form method="POST">
                @csrf
                <h1>Регистрация</h1>
                <div class="form-group">
                    <label for="FIO" class="form-label">ФИО</label>
                    <input type="text" class="form-control @error('FIO') is-invalid @enderror" id="FIO" name="FIO" value="{{ old('FIO') }}">
                    @error('FIO')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">Номер телефона</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="+7(999)-999-99-99" value="{{ old('phone') }}">
                    @error('phone')
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
                <div class="form-group">
                    <label for="telegram_user" class="form-label">Telegram User</label>
                    <input type="text" class="form-control @error('telegram_user') is-invalid @enderror" id="telegram_user" name="telegram_user" placeholder="@username" value="{{ old('telegram_user') }}">
                    @error('telegram_user')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn-register">Зарегистрироваться</button>
            </form>
        </div>
    </div>
@endsection
