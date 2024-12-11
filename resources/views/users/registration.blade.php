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
            <form style="background-color: rgba(0,0,0,0.53); padding: 20px; border-radius: 20px; color: white">
                @csrf
                <h1>Регистрация</h1>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">FIO</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #FFC300; color: black; border: 1px solid black">Submit</button>
            </form>
        </div>
    </div>
@endsection
