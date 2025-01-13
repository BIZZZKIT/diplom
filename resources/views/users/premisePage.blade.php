@extends('welcome')
@section('title', "{$premise->federalDistricts->name}, {$premise->regions->name}, {$premise->cities->name}, {$premise->address}")
@section('content')
    <div class="container" style="display: flex; gap: 50px">
        <div class="carousel-premise">
            @if($premise->images->isNotEmpty())
                <div id="carousel-{{ $premise->id }}" class="carousel slide" data-bs-ride="carousel"
                     style="width: 817px; height: 490px">
                    <div class="carousel-inner" style="border-radius: 20px">
                        @foreach($premise->images->pluck('path')->toArray() as $index => $path)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $path) }}" class="d-block w-100"
                                     style="height: 490px; border-radius: 20px"
                                     alt="Image {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $premise->id }}"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $premise->id }}"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif
            <h1>Где находится на карте:</h1>
                <div id="map" style="height: 500px; width: 100%; padding-top: 30px; border-radius: 20px"></div>

                <script>
                    function initMap(region, city, address) {
                        const geocodeUrl = `https://geocode-maps.yandex.ru/1.x/?format=json&geocode=${region}, ${city}, ${address}&apikey=3c919aec-a764-4502-9dcf-caf7c92e7a42`;

                        fetch(geocodeUrl)
                            .then(response => response.json())
                            .then(data => {

                                const featureMember = data.response.GeoObjectCollection.featureMember;
                                if (!featureMember.length) {
                                    console.error('Address not found in Geocode API response');
                                    alert('Не удалось найти указанный адрес. Проверьте правильность ввода.');
                                    return;
                                }

                                const pos = featureMember[0].GeoObject.Point.pos.split(' ');
                                const coordinates = [parseFloat(pos[1]), parseFloat(pos[0])];

                                console.log('Parsed Coordinates:', coordinates);

                                const map = new ymaps.Map("map", {
                                    center: coordinates,
                                    zoom: 15,
                                });

                                const placemark = new ymaps.Placemark(coordinates, {
                                    balloonContent: `${region}, ${city}, ${address}`,
                                });

                                map.geoObjects.add(placemark);
                            })
                            .catch(error => {
                                console.error('Error fetching geocode data:', error);
                                alert('Ошибка при получении данных карты. Попробуйте позже.');
                            });
                    }

                    ymaps.ready(() => {
                        const region = '{{ $premise->regions->name }}';
                        const city = '{{ $premise->cities->name }}';
                        const address = '{{ $premise->address }}';

                        initMap(region, city, address);
                    });

                </script>
        </div>
        <div class="info-premise" style="font-family: 'Montserrat', sans-serif">
            <h2>{{$premise->price}} Рублей</h2>
            <p>{{$premise->federalDistricts->name}}, {{$premise->regions->name}}, {{$premise->cities->name}}, {{$premise->address}}</p>
            <h3>Пользователь: <br>{{$premise->user->FIO}} <br> <br> Telegram: {{$premise->user->telegram_user}}</h3>
            <h2>Описание: <p>{{$premise->description}}</p></h2>
        </div>

    </div>
@endsection
