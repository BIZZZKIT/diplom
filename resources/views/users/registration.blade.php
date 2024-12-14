<style>
    .form-control:focus {
        box-shadow: 0 0 10px #FFC300;
        border-color: #FFC300;
        outline: none;
    }
</style>
@extends('welcome')
@section('title', 'Регистрация')
@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-4" style="font-family: Montserrat">
            <form method="POST" style="background-color: rgba(0,0,0,0.53); padding: 20px; border-radius: 20px; color: white">
                @csrf
                <h1>Регистрация</h1>
                <div class="mb-3">
                    <label for="FIO" class="form-label">ФИО</label>
                    <input type="text" class="form-control @error('FIO') is-invalid @enderror" id="FIO" name="FIO" required>
                    @error('FIO')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Номер телефона</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="8(999)-999-99-99" required>
                    @error('phone')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telegram_user" class="form-label">Telegram User</label>
                    <input type="text" class="form-control @error('telegram_user') is-invalid @enderror" id="telegram_user" name="telegram_user" placeholder="@username">
                    @error('telegram_user')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #FFC300; color: black; border: 1px solid black">Зарегистрироваться</button>
            </form>
        </div>
    </div>
@endsection
