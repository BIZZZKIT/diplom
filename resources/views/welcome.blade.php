@php use Illuminate\Support\Facades\Route; @endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.js')}}"></script>
    <title>@yield('title', 'Главная страница')</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
    body {
        margin: 0;
        height: 100vh;
        background: linear-gradient(90deg, #000000 0%, #5B5400 50%, #000000 100%) no-repeat fixed;
        background-size: cover;
    }

</style>
<body>
@if(!Route::is('login') && !Route::is('registration'))
    @include('components.header')
@endif
@yield('content')
@if(Route::is('welcome'))
    @include('main')
@endif
</body>
</html>


