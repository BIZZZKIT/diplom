@extends('welcome')
@section('title', "{$premise->federalDistricts->name}, {$premise->regions->name}, {$premise->cities->name}, {$premise->address}")
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap');

        :root {
            --primary: #000000;
            --accent: #FFC300;
            --background: #FFFFFF;
            --text-dark: #ffffff;
            --text-light: #ffffff;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-dark);
            background-color: var(--background);
            line-height: 1.6;
        }

        .premise-container {
            display: flex;
            gap: 40px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        /* Gallery Section */
        .gallery-section {
            flex: 2;
        }

        .gallery-container {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .gallery-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
            transition: var(--transition);
        }

        .carousel:hover .carousel-control-prev,
        .carousel:hover .carousel-control-next {
            opacity: 1;
        }

        /* Map Section */
        .map-section {
            margin-top: 40px;
        }

        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 24px;
            color: white;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--accent);
        }

        #map {
            height: 400px;
            width: 100%;
            border-radius: 16px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        #map:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Info Section */
        .info-section {
            flex: 1;
            position: sticky;
            top: 20px;
            height: fit-content;
        }

        .price-tag {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 32px;
            color: white;
            margin-bottom: 15px;
        }

        .location-info {
            font-size: 16px;
            color: var(--text-light);
            margin-bottom: 25px;
            line-height: 1.7;
        }

        .owner-info {
            background-color: rgba(255, 195, 0, 0.1);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 3px solid var(--accent);
        }

        .owner-name {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .owner-contact {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
            color: var(--text-dark);
        }

        .contact-btn {
            display: inline-block;
            background-color: var(--accent);
            color: var(--primary);
            padding: 12px 25px;
            border-radius: 30px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            margin-bottom: 25px;
        }

        .contact-btn:hover {
            background-color: var(--primary);
            color: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .description-section {
            margin-top: 30px;
        }

        .description-text {
            font-size: 16px;
            line-height: 1.8;
            color: var(--text-dark);
        }

        .panoramas-section {
            background-color: rgba(0, 0, 0, 0.03);
            padding: 60px 20px;
            margin-top: 60px;
        }

        .panoramas-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-header h2 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 32px;
            color: white;
            position: relative;
            display: inline-block;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--accent);
        }

        .panorama-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
            transition: var(--transition);
        }

        .panorama-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .panorama-header {
            background-color: var(--primary);
            color: var(--background);
            padding: 15px 20px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        .panorama-viewer {
            height: 500px;
            width: 100%;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .premise-container {
                flex-direction: column;
            }

            .info-section {
                position: static;
            }

            .carousel-item img {
                height: 400px;
            }

            #map {
                height: 350px;
            }
        }

        @media (max-width: 768px) {
            .carousel-item img {
                height: 300px;
            }

            .price-tag {
                font-size: 28px;
            }

            .section-header h2 {
                font-size: 28px;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }
    </style>

    <div class="premise-container">
        <div class="gallery-section">
            <div class="gallery-container fade-in">
                @if($premise->images->isNotEmpty())
                    <div id="carousel-{{ $premise->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($premise->images->pluck('path')->toArray() as $index => $path)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('public/storage/' . $path) }}" class="d-block w-100" alt="Image {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $premise->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $premise->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @endif
            </div>

            <div class="map-section fade-in delay-1">
                <h2 class="section-title">Где находится на карте</h2>
                <div id="map"></div>
            </div>
        </div>

        <div class="info-section fade-in delay-2">
            <div class="price-tag">{{ number_format($premise->price, 0, ',', ' ') }} ₽</div>
            <div class="location-info">
                {{$premise->federalDistricts->name}}, {{$premise->regions->name}}<br>
                {{$premise->cities->name}}, {{$premise->address}}
            </div>

            <div class="owner-info">
                <div class="owner-name">Владелец</div>
                <p>{{$premise->user->FIO}}</p>
                <div class="owner-contact">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    {{$premise->user->phone}}
                </div>
            </div>

            <button type="button" onclick="startChat({{ $premise->user->id }})" class="contact-btn">
                Написать владельцу
            </button>

            <div class="description-section">
                <h2 class="section-title">Описание</h2>
                <div class="description-text">{{$premise->description}}</div>
            </div>
        </div>
    </div>

    @if($premise->panoramas->isNotEmpty())
        <div class="panoramas-section fade-in delay-3">
            <div class="panoramas-container">
                <div class="section-header">
                    <h2>Панорамы помещений</h2>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach($premise->panoramas as $panorama)
                        <div class="col-md-8">
                            <div class="panorama-card">
                                <div class="panorama-header">
                                    {{ $panorama->room_name }}
                                </div>
                                <div class="panorama-viewer"
                                     data-panorama="{{ asset('public/storage/' . $panorama->path) }}"
                                     data-id="{{ $panorama->id }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

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

                    const map = new ymaps.Map("map", {
                        center: coordinates,
                        zoom: 15,
                    });

                    const placemark = new ymaps.Placemark(coordinates, {
                        balloonContent: `${region}, ${city}, ${address}`,
                    }, {
                        iconLayout: 'default#image',
                        iconImageHref: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
                        iconImageSize: [40, 40],
                        iconImageOffset: [-20, -40]
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

        window.startChat = function (userId) {
            $.post('/chat/start', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                user_id: userId
            }, function (response) {
                if (response.success) {
                    toggleChatPopup();
                    openChat(response.chat_id);
                } else {
                    alert('Не удалось начать чат');
                }
            });
        }
    </script>
@endsection
