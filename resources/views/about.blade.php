<style>
    .history {
        position: relative;
        background-image: url('{{asset('assets/images/_Cream_color_in_the_living_room_091224_.jpg')}}');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        border-radius: 20px; /* Закругление краёв */
        overflow: hidden;
        width: 80%; /* Ширина карточки */
        margin: 20px auto; /* Центрирование */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Добавляем тень */
    }

    .history::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black; /* Затемняющий цвет */
        opacity: 0.8; /* Прозрачность затемнения */
        z-index: 1;
    }

    .container {
        position: relative;
        z-index: 2; /* Контейнер поверх затемнения */
    }

    .service-card {
        background-color: #000000;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .service-card:hover {
        transform: scale(1.03);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }
</style>



@extends('welcome')
@section('title', 'О компании')
@section('content')
<div class="history">
    <div class="container my-5">
        <h1 class="text-center mb-4" style="font-size: 2.5rem; font-weight: bold;">История компании HouseWorld</h1>
        <p style="font-size: 1.2rem; line-height: 1.6;">
            Компания <strong>HouseWorld</strong> начала свою деятельность в 2010 году в Москве с простой, но амбициозной миссии:
            сделать покупку, продажу и аренду недвижимости максимально прозрачным, удобным и безопасным процессом для клиентов.
        </p>

        <h2 class="mt-4" style="font-size: 2rem; font-weight: bold;">Идея создания</h2>
        <p style="font-size: 1.2rem; line-height: 1.6;">
            Идея создания HouseWorld родилась у её основателя, Александра Романова, в момент, когда он сам столкнулся с трудностями поиска квартиры для своей семьи.
            Постоянные недостоверные объявления, завышенные цены и сложные переговоры с риелторами вдохновили его на создание платформы, которая бы объединила профессионалов и клиентов,
            предлагая честный сервис и современные решения.
        </p>

        <h2 class="mt-4" style="font-size: 2rem; font-weight: bold;">Первые шаги</h2>
        <p style="font-size: 1.2rem; line-height: 1.6;">
            Сначала компания представляла собой небольшой стартап, работающий только в пределах Москвы. Команда из трёх человек, энтузиастов своего дела, вручную проверяла каждое объявление,
            чтобы гарантировать их достоверность. Уже в первый год работы компания смогла привлечь внимание клиентов, установив стандарты прозрачности и ответственности.
        </p>

        <h2 class="mt-4" style="font-size: 2rem; font-weight: bold;">Расширение</h2>
        <p style="font-size: 1.2rem; line-height: 1.6;">
            В 2020 году, несмотря на вызовы пандемии, HouseWorld расширила свою деятельность в другие регионы России, открыв офисы в Санкт-Петербурге, Казани и Екатеринбурге.
            Компания активно использовала видеотуры и дистанционные сделки, что позволило ей удерживать лидерство даже в сложных условиях.
        </p>

        <h2 class="mt-4" style="font-size: 2rem; font-weight: bold;">Сегодня и завтра</h2>
        <p style="font-size: 1.2rem; line-height: 1.6;">
            Сегодня HouseWorld – это команда из более чем 500 специалистов, которые ежедневно помогают тысячам клиентов находить жильё своей мечты.
            Компания гордится своей репутацией надёжного партнёра, предоставляющего полный спектр услуг – от оценки недвижимости до юридического сопровождения сделок.
        </p>
        <p style="font-size: 1.2rem; line-height: 1.6;">
            В будущем HouseWorld планирует выйти на международный рынок, предлагая свои инновационные решения в области недвижимости в Европе и Азии.
            Главная цель компании остаётся неизменной – дарить людям комфорт и уверенность в их решениях, связанных с недвижимостью.
        </p>

        <h2 class="mt-4" style="font-size: 2rem; font-weight: bold;">Миссия и ценности</h2>
        <ul style="font-size: 1.2rem; line-height: 1.6; list-style-type: disc; padding-left: 20px;">
            <li><strong>Прозрачность:</strong> каждый клиент должен понимать процесс и быть уверенным в сделке.</li>
            <li><strong>Технологии:</strong> использование современных инструментов для повышения качества сервиса.</li>
            <li><strong>Доверие:</strong> персональный подход и поддержка на всех этапах сотрудничества.</li>
        </ul>
        <p style="font-size: 1.2rem; line-height: 1.6;">
            Компания продолжает следовать этим принципам, вдохновляя доверие и укрепляя своё лидерство в индустрии недвижимости.
        </p>
    </div>

</div>
<div class="services-section py-5">
    <div class="container">
        <h2 class="text-center mb-4" style="font-size: 2.5rem; font-weight: bold;">Наши услуги</h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="service-card p-4 border rounded shadow-sm">
                    <h3 class="mb-3" style="font-size: 1.8rem; font-weight: bold;">Продажа и покупка недвижимости</h3>
                    <ul style="font-size: 1.2rem; line-height: 1.6; list-style-type: disc; padding-left: 20px;">
                        <li>Удобные фильтры для поиска объектов по всем параметрам.</li>
                        <li>Личные кабинеты для размещения и управления объявлениями.</li>
                        <li>Система рейтингов и отзывов для доверия к продавцам.</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="service-card p-4 border rounded shadow-sm">
                    <h3 class="mb-3" style="font-size: 1.8rem; font-weight: bold;">Аренда жилья и коммерческих помещений</h3>
                    <ul style="font-size: 1.2rem; line-height: 1.6; list-style-type: disc; padding-left: 20px;">
                        <li>Быстрая публикация объявлений.</li>
                        <li>Возможность заключать дистанционные договоры.</li>
                        <li>Поддержка онлайн-чатов с арендодателями.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
