@extends('welcome')
@section('title', 'Контакты')
@section('content')
    @if(session('successCreateReview'))
        <div
            class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
            style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
            {{ session('successCreateReview') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    @endif
    <div class="reviewForm pt-4" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding-bottom: 100px;">
        <div class="d-flex justify-content-center">
            <h1>Оставьте отзыв о нашей работе</h1>
        </div>
        <div class="container" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 20px;">
            <form method="post" action="{{route('createReview')}}" style="display: flex; flex-direction: column; align-items: center; gap: 15px; padding-top: 40px;">
                @csrf
                <div class="textarea">
                    <textarea class="form-control" style="width: 700px;" name="textReview" id="textReview" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-warning">Отправить</button>
            </form>
        </div>
    </div>
    <div class="contacts">
        <div class="container d-flex justify-content-center">
            <h1>Где мы  находимся и наши контактные данные</h1>
        </div>
        <div class="container d-flex justify-content-center align-items-center" style="gap: 20px;">
            <div id="map" style="height: 500px; width: 500px; padding-top: 30px; border-radius: 20px"></div>
            <div class="contactData" style="position: relative; border-radius: 20px; background-image: url('{{asset('public/assets/images/1599719638_3417.jpeg')}}'); background-repeat: no-repeat; background-size: cover; padding: 60px; color: white">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); border-radius: 20px; z-index: 1;"></div>

                <div style="position: relative; z-index: 2;">
                    <h2>Контактная информация</h2>
                    <p><strong>Адрес:</strong> г. Москва, ул. Арбат, д. 12, офис 304</p>
                    <p><strong>Телефон:</strong> <a href="tel:+74951234567" style="color: #FFC300; text-decoration: none;">+7 (495) 123-45-67</a></p>
                    <p><strong>Email:</strong> <a href="mailto:hworld@gmail.com" style="color: #FFC300; text-decoration: none;">hworld@gmail.com</a></p>
                    <h3>Часы работы:</h3>
                    <ul style="list-style-type: none; padding: 0;">
                        <li>Понедельник - Пятница: 09:00 - 19:00</li>
                        <li>Суббота: 10:00 - 16:00</li>
                        <li>Воскресенье: Выходной</li>
                    </ul>
                </div>
            </div>



            <script>
                const geocodeUrl = `https://geocode-maps.yandex.ru/1.x/?format=json&geocode=г. Москва, ул. Арбат, д. 12, офис 304&apikey=3c919aec-a764-4502-9dcf-caf7c92e7a42`;

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
                            balloonContent: `г. Москва, ул. Арбат, д. 12, офис 304`,
                        });

                        map.geoObjects.add(placemark);
                    })
                    .catch(error => {
                        console.error('Error fetching geocode data:', error);
                        alert('Ошибка при получении данных карты. Попробуйте позже.');
                    });

                ymaps.ready(() => {
                    initMap();
                });


            </script>
        </div>
    </div>
    <div class="staff" style="padding: 50px 0">
        <div class="container">
            <h1 style="text-align: center; margin-bottom: 40px;">Наши специалисты</h1>
            <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                    <img src="{{asset('public/assets/images/i.webp')}}" alt="Фото директора" style="width: 250px; height: 250px; border-radius: 50%; margin-bottom: 20px;">
                    <h3 style="font-family: Arial, sans-serif;">Иван Петров</h3>
                    <p style="font-family: Arial, sans-serif; color: #cbcbcb;">Директор</p>
                    <p style="font-family: Arial, sans-serif; color: #cbcbcb;">С нами с 2015 года</p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{asset('public/assets/images/i(1).webp')}}" alt="Фото генерального директора" style="width: 250px; height: 250px; border-radius: 50%; margin-bottom: 20px;">
                    <h3 style="font-family: Arial, sans-serif;">Екатерина Смирнова</h3>
                    <p style="font-family: Arial, sans-serif; color: #cbcbcb;">Генеральный директор</p>
                    <p style="font-family: Arial, sans-serif; color: #cbcbcb;">В компании с 2012 года</p>
                </div>

                <div class="col-md-4 text-center">
                    <img src="{{asset('public/assets/images/3247bd487e4bab8dc2256b91371af6bd.jpg')}}" alt="Фото оператора поддержки" style="width: 250px; height: 250px; border-radius: 50%; margin-bottom: 20px;">
                    <h3 style="font-family: Arial, sans-serif;">Алексей Сидоров</h3>
                    <p style="font-family: Arial, sans-serif; color: #cbcbcb;">Оператор поддержки</p>
                    <p style="font-family: Arial, sans-serif; color: #cbcbcb;">Работает с 2020 года</p>
                </div>
            </div>
        </div>
    </div>

@endsection
