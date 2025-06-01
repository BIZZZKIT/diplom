@extends('welcome')
@section('title', "{$premise->federalDistricts->name}, {$premise->regions->name}, {$premise->cities->name}, {$premise->address}")
@section('content')
    <div class="container" style="display: flex; gap: 50px">
        <div class="carousel-premise" style="flex: 2">
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

            <h1 style="margin-top: 30px">Где находится на карте:</h1>
            <div id="map" style="height: 500px; width: 817px; margin-top: 30px; border-radius: 20px; margin-bottom: 20px"></div>

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

        <div class="info-premise" style="font-family: 'Montserrat', sans-serif; flex: 1">
            <h2>{{$premise->price}} Рублей</h2>
            <p>{{$premise->federalDistricts->name}}, {{$premise->regions->name}}, {{$premise->cities->name}}, {{$premise->address}}</p>
            <h3>Пользователь: <br>{{$premise->user->FIO}} <br> <br> Telegram: {{$premise->user->telegram_user}}</h3>
            <form style="padding: 10px 0px">
                <button type="button" onclick="startChat({{ $premise->user->id }})" class="btn btn-primary" style="background-color: #5B5400; border: none; padding: 10px 40px">
                    Написать
                </button>
            </form>
            <script>
                window.startChat = function (userId) {
                    $.post('/chat/start', {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        user_id: userId
                    }, function (response) {
                        if (response.success) {
                            toggleChatPopup(); // Показываем popup
                            openChat(response.chat_id); // Открываем нужный чат
                        } else {
                            alert('Не удалось начать чат');
                        }
                    });
                }
            </script>
            <h2>Описание: <p>{{$premise->description}}</p></h2>
        </div>
    </div>

    @if($premise->panoramas->isNotEmpty())
        <div class="container mt-5 mb-5" style="max-width: 1200px; margin: 0 auto;">
            <div class="panoramas-container">
                <h2 class="text-center mb-4" style="color: white">Панорамы комнат</h2>

                <div class="row g-4 justify-content-center">
                    @foreach($premise->panoramas as $panorama)
                        <div class="col-md-8 panorama-item">
                            <div class="card shadow-sm">
                                <div class="card-header bg-dark text-white">
                                    <h3 class="h5 mb-0 text-center">{{ $panorama->room_name }}</h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="panorama-viewer"
                                         style="width: 100%; height: 500px;"
                                         data-panorama="{{ asset('storage/' . $panorama->path) }}"
                                         data-id="{{ $panorama->id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <style>
            .panoramas-container {
                padding: 30px;
                background-color: rgba(0, 0, 0, 0.3);
                border-radius: 15px;
                box-shadow: 0 0 15px rgba(0,0,0,0.1);
            }
            .panorama-item {
                margin-bottom: 40px;
            }
            .panorama-viewer {
                border-radius: 0 0 5px 5px;
                overflow: hidden;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (!window.PhotoSphereViewer || !window.THREE) {
                    console.error('Required libraries not loaded');
                    return;
                }

                document.querySelectorAll('.panorama-viewer').forEach(container => {
                    const panoramaPath = container.dataset.panorama;
                    const panoramaId = container.dataset.id;

                    try {
                        new PhotoSphereViewer.Viewer({
                            container: container,
                            panorama: panoramaPath,
                            loadingImg: 'https://photo-sphere-viewer.js.org/assets/photosphere-logo.gif',
                            loadingTxt: 'Загрузка панорамы...',
                            defaultZoomLvl: 50,
                            navbar: [
                                'zoom',
                                'move',
                                'download',
                                'fullscreen'
                            ],
                            plugins: [],
                            lang: {
                                zoom: 'Приближение',
                                move: 'Перемещение',
                                download: 'Скачать',
                                fullscreen: 'Полный экран'
                            }
                        });
                    } catch (error) {
                        console.error(`Failed to initialize panorama ${panoramaId}:`, error);
                    }
                });
            });
        </script>
    @endif
@endsection
