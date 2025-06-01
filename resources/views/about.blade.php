<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #212529;
    }

    .history {
        position: relative;
        background-size: cover;
        background-position: center;
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 0;
    }

    .glass-panel {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        padding: 40px;
        max-width: 900px;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .glass-panel h1, .glass-panel h2 {
        color: #ffffff;
    }

    .glass-panel p, .glass-panel li {
        color: #f1f1f1;
    }

    .services-section {
        padding: 60px 20px;
    }

    .service-card {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        padding: 30px;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        color: #ffffff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }


    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .service-card h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .service-card ul {
        padding-left: 20px;
    }

    .service-icon {
        font-size: 2rem;
        color: #dfce01;
        margin-right: 10px;
    }

    @media (max-width: 768px) {
        .glass-panel {
            padding: 20px;
        }

        .service-card {
            padding: 20px;
        }
    }
</style>




@extends('welcome')
@section('title', 'О компании')

@section('content')

    <div class="history">
        <div class="glass-panel">
            <h1 class="text-center mb-4">История компании HouseWorld</h1>
            <p><strong>HouseWorld</strong> начала свою деятельность в 2010 году в Москве с амбициозной миссией — сделать рынок недвижимости понятным и удобным для всех.</p>

            <h2 class="mt-4">Идея создания</h2>
            <p>Вдохновлённый собственными трудностями поиска жилья, Александр Романов основал HouseWorld, чтобы объединить клиентов и профессионалов на прозрачной платформе.</p>

            <h2 class="mt-4">Первые шаги</h2>
            <p>Три человека, ручная проверка, высокие стандарты — так началась история, которая быстро привлекла внимание рынка.</p>

            <h2 class="mt-4">Расширение</h2>
            <p>В 2020 году HouseWorld вышла на рынок других городов, внедрив видеотуры и онлайн-сделки в условиях пандемии.</p>

            <h2 class="mt-4">Сегодня и завтра</h2>
            <p>Более 500 сотрудников, тысячи клиентов и международные амбиции — всё это HouseWorld сегодня.</p>

            <h2 class="mt-4">Миссия и ценности</h2>
            <ul>
                <li><strong>Прозрачность:</strong> доверие через ясные процессы.</li>
                <li><strong>Технологии:</strong> инновации для удобства клиентов.</li>
                <li><strong>Доверие:</strong> индивидуальный подход и поддержка.</li>
            </ul>
        </div>
    </div>

    <div class="services-section">
        <div class="container">
            <h2 class="text-center mb-5">Наши услуги</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="service-card">
                        <h3><i class="service-icon bi bi-house-door-fill"></i> Продажа и покупка недвижимости</h3>

                        <p>Удобные фильтры и карта объектов</p>
                        <p>Личный кабинет для управления объявлениями</p>
                        <p>Отзывы и рейтинги продавцов</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="service-card">
                        <h3><i class="service-icon bi bi-key-fill"></i> Аренда жилья и коммерции</h3>
                        <p>Быстрая публикация и дистанционные договоры</p>
                        <p>Поддержка онлайн-чата с арендодателями</p>
                        <p>Интеграция с картой и фильтрами</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

