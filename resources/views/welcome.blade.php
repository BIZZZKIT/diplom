@php use Illuminate\Support\Facades\Route; @endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('public/assets/images/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photo-sphere-viewer@4/dist/photo-sphere-viewer.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uevent@2/browser.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/photo-sphere-viewer@4/dist/photo-sphere-viewer.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=3c919aec-a764-4502-9dcf-caf7c92e7a42&lang=ru_RU"
            type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.3/echo.iife.js"></script>
    <title>@yield('title', 'Главная страница')</title>
</head>
<script>
    $(document).ready(function () {
        $('#district_id').on('change', function () {
            let districtId = $(this).val();

            if (districtId) {
                $('#region_block').show();
                $.ajax({
                    url: '/catalog/regions/' + districtId,
                    method: 'GET',
                    success: function (data) {
                        if (data && data.length > 0) {
                            $('#region_id').empty().append('<option value="">Выберите регион</option>');
                            $.each(data, function (index, region) {
                                $('#region_id').append('<option value="' + region.id + '">' + region.name + '</option>');
                            });
                            $('#region_block').show();
                        } else {
                            $('#region_block').hide();
                        }
                    },
                    error: function () {
                        console.error('Error loading regions');
                        $('#region_block').hide();
                    }
                });
            } else {
                $('#region_block').hide();
            }
        });
        $('#region_id').on('change', function () {
            let regionId = $(this).val();

            if (regionId) {
                $('#city_block').show();
                $.ajax({
                    url: '/catalog/cities/' + regionId,
                    method: 'GET',
                    success: function (data) {
                        if (data && data.length > 0) {
                            $('#city_id').empty().append('<option value="">Выберите город</option>');
                            $.each(data, function (index, region) {
                                $('#city_id').append('<option value="' + region.id + '">' + region.name + '</option>');
                            });
                            $('#city_block').show();
                        } else {
                            $('#city_block').hide();
                        }
                    },
                    error: function () {
                        console.error('Error loading regions');
                        $('#city_block').hide();
                    }
                });
            } else {
                $('#city_block').hide();
            }
        });
        $('#regionsFil').html('<option value="">Сначала выберите фед.округ</option>');
        $('#citiesFil').html('<option value="">Сначала выберите регион</option>');

        $('#federalDistrictsFil').on('change', function () {
            let districtFilId = $(this).val();

            if (!districtFilId) {
                $('#regionsFil').html('<option value="">Сначала выберите фед.округ</option>');
                $('#citiesFil').html('<option value="">Сначала выберите регион</option>');
            } else {
                $.ajax({
                    url: '/catalog/regions/' + districtFilId,
                    method: 'GET',
                    success: function (data) {
                        let options = '<option value="">Выберите регион</option>';
                        $.each(data, function (index, region) {
                            options += `<option value="${region.id}">${region.name}</option>`;
                        });
                        $('#regionsFil').html(options);
                        $('#citiesFil').html('<option value="">Сначала выберите регион</option>');
                    }
                });
            }
        });

        $('#regionsFil').on('change', function () {
            let regionsFilId = $(this).val();

            if (!regionsFilId) {
                $('#citiesFil').html('<option value="">Сначала выберите регион</option>');
            } else {
                $.ajax({
                    url: '/catalog/cities/' + regionsFilId,
                    method: 'GET',
                    success: function (data) {
                        let options = '<option value="">Выберите город</option>';
                        $.each(data, function (index, city) {
                            options += `<option value="${city.id}">${city.name}</option>`;
                        });
                        $('#citiesFil').html(options);
                    }
                });
            }
        });

    });
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

    body {
        margin: 0;
        height: 100vh;
        background: linear-gradient(90deg, #000000 0%, #5B5400 50%, #000000 100%) no-repeat fixed;
        background-size: cover;
    }

    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }

    footer {
        background-color: black;
        color: white;
    }
</style>
<body>
<div class="wrapper">
    @if(!Route::is('login') && !Route::is('registration'))
        @include('components.header')
    @endif

    <main>
        @yield('content')
    </main>

    @if(Route::is('welcome'))
        @include('main')
    @endif

    @if(!Route::is('login') && !Route::is('registration'))
        <footer>
            <div style="background-color: black; padding: 20px;">
                <div class="container d-flex justify-content-between align-items-center">
                    <div class="address" style="width: 237px">
                        г. Москва, ул. Арбат, д. 12, офис 304<br>
                        +7 (495) 123-45-67<br>
                        hworld@gmail.com
                    </div>
                    <img src="{{asset('assets/images/logo.png')}}" alt="Логотип" width="200px">
                    <div class="icons" style="gap: 20px">
                        <img width="50px" src="{{asset('assets/images/telegram.png')}}" alt="Telegram">
                        <img width="50px" src="{{asset('assets/images/vk.png')}}" alt="VK">
                    </div>
                </div>
            </div>
        </footer>
    @endif
</div>
@auth()
    @include('components.chat')
@endauth
</body>
</html>



