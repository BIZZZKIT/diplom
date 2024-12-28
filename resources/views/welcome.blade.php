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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


