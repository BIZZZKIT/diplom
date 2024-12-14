<style>
    .form-control:focus {
        box-shadow: 0 0 10px #FFC300;
        border-color: #FFC300;
        outline: none;
    }
</style>
@extends('welcome')
@section('title', 'Авторизация')
@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-4" style="font-family: Montserrat">
            <form method="POST" style="background-color: rgba(0,0,0,0.53); padding: 20px; border-radius: 20px; color: white">
                @csrf
                <h1>Авторизация</h1>
                @if($errors->has('error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('error') }}
                    </div>
                @endif
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
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #FFC300; color: black; border: 1px solid black">Войти</button>
            </form>
        </div>
    </div>
@endsection
