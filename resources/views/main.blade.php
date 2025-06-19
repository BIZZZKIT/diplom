<style>
    /* Общие стили */
    body {
        background-color: #1a1a1a;
        color: white;
        font-family: 'Montserrat', sans-serif;
    }

    /* Форма поиска */
    .search-section {
        position: relative;
        background-image: url('{{ asset('public/assets/images/forformmain.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
        text-align: center;
    }

    .search-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.75);
        z-index: 1;
    }

    .search-card {
        position: relative;
        z-index: 2;
        background-color: #1a1a1a;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        width: 100%;
    }

    .search-card h1 {
        font-size: 2rem;
        font-weight: 600;
        color: #FFC300;
        margin-bottom: 1.5rem;
    }

    .search-form {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    .form-control,
    .form-select {
        background-color: #333;
        border: 1px solid #555;
        border-radius: 8px;
        color: white;
        padding: 0.75rem;
        font-size: 0.95rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #FFC300;
        box-shadow: 0 0 10px #FFC300;
        outline: none;
    }

    /* Стили для placeholder */
    .form-control::placeholder,
    .form-select::placeholder {
        color: white;
        opacity: 1; /* Для Firefox */
    }

    /* Кроссбраузерная поддержка */
    .form-control::-webkit-input-placeholder,
    .form-select::-webkit-input-placeholder {
        color: white;
    }

    .form-control::-moz-placeholder,
    .form-select::-moz-placeholder {
        color: white;
        opacity: 1;
    }

    .form-control:-ms-input-placeholder,
    .form-select:-ms-input-placeholder {
        color: white;
    }

    .btn-search {
        grid-column: 2 / span 2;
        background-color: #FFC300;
        color: black;
        border: none;
        border-radius: 8px;
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-search:hover {
        background-color: #FFD700;
        transform: translateY(-2px);
    }

    /* Новости */
    .news-section {
        padding: 60px 0;
        text-align: center;
    }

    .news-section h1 {
        font-size: 2rem;
        font-weight: 600;
        color: #FFC300;
        margin-bottom: 2rem;
    }

    .cards-news {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        width: 100%;
    }

    .news-card {
        width: 100%;
        background-color: #1a1a1a;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(255, 195, 0, 0.3);
    }

    .news-card img {
        height: 180px;
        object-fit: cover;
        width: 100%;
    }

    .news-card .card-body {
        padding: 1rem;
    }

    .news-card h4 {
        font-size: 1.2rem;
        color: #FFC300;
        margin-bottom: 0.5rem;
    }

    .news-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .news-overlay.active {
        display: flex;
    }

    .news-popup {
        background-color: #1a1a1a;
        padding: 2rem;
        width: 90%;
        max-width: 700px;
        max-height: 80vh;
        overflow-y: auto;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
        position: relative;
        color: white;
    }

    .news-popup img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }

    .news-popup h2 {
        font-size: 1.5rem;
        color: #FFC300;
        margin-bottom: 1rem;
    }

    .news-popup p {
        font-size: 1rem;
        line-height: 1.6;
        color: white;
        word-break: break-word;
        overflow-wrap: anywhere;
        white-space: normal;
        width: 100%;
    }

    .close-overlay {
        position: absolute;
        top: 15px;
        right: 20px;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #FFC300;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .close-overlay:hover {
        color: #FFD700;
    }

    /* Отзывы */
    .reviews-section {
        position: relative;
        background-image: url('{{ asset('public/assets/images/backgroundReviews.png') }}');
        background-size: cover;
        background-position: center;
        padding: 60px 0;
    }

    .reviews-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1;
    }

    .reviews-container {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .reviews-container h1 {
        font-size: 2rem;
        font-weight: 600;
        color: #FFC300;
        margin-bottom: 2rem;
    }

    .cards-reviews {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        width: 100%;
    }

    .review-card {
        width: 100%;
        background-color: #1a1a1a;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .review-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(255, 195, 0, 0.3);
    }

    .review-card h3 {
        font-size: 1.1rem;
        color: #FFC300;
        margin-bottom: 0.75rem;
    }

    .review-card p {
        font-size: 0.9rem;
        color: #ddd;
        line-height: 1.5;
    }

    /* Уведомления */
    .alert-success {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #f6ebc0;
        color: #FFC300;
        border: none;
        border-radius: 8px;
        padding: 1rem;
        z-index: 1050;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .alert-success .btn-close {
        background-color: transparent;
        border: none;
        font-size: 1rem;
    }

    /* Адаптивность */
    @media (max-width: 992px) {
        .search-form {
            grid-template-columns: repeat(2, 1fr);
        }

        .btn-search {
            grid-column: 1 / span 2;
        }

        .cards-news {
            grid-template-columns: repeat(2, 1fr);
        }

        .cards-reviews {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .search-form {
            grid-template-columns: 1fr;
        }

        .btn-search {
            grid-column: 1;
        }

        .cards-news,
        .cards-reviews {
            grid-template-columns: 1fr;
        }

        .search-card,
        .news-popup {
            padding: 1.5rem;
        }

        .search-card h1,
        .news-section h1,
        .reviews-container h1 {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow" style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    @endif
    <div id="carouselExample" class="carousel slide" style="border-radius: 20px; padding-top: 57px; padding-bottom: 58px;">
        <div class="carousel-inner" style="border-radius: 20px; overflow: hidden; max-height: 670px;">
            <div class="carousel-item active">
                <img src="{{ asset('public/assets/images/carousel/2f6865a8366bde9d6401bf8877276e7e2e6feb8c.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('public/assets/images/carousel/chelyabinsk_manhatten.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('public/assets/images/carousel/ярославский.png') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="search-section">
    <div class="container">
        <div class="search-card">
            <h1>Найди свою мечту</h1>
            <form action="{{ route('catalog.filter') }}" method="GET" class="search-form">
                <div class="mb-3">
                    <select class="form-select" name="type">
                        <option value="">Все</option>
                        <option value="Продажа" {{ request('typeOfSell') == 'Продажа' ? 'selected' : '' }}>Продажа</option>
                        <option value="Аренда" {{ request('typeOfSell') == 'Аренда' ? 'selected' : '' }}>Аренда</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="category">
                        <option value="">Все</option>
                        <option value="Квартира" {{ request('flatOrHouse') == 'Квартира' ? 'selected' : '' }}>Квартира</option>
                        <option value="Дом" {{ request('flatOrHouse') == 'Дом' ? 'selected' : '' }}>Дом</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input class="form-control" name="count_room" placeholder="Кол-во комнат" value="{{ request('count_room') }}">
                </div>
                <div class="mb-3">
                    <input class="form-control" name="price_min" placeholder="От" value="{{ request('price_min') }}">
                </div>
                <div class="mb-3">
                    <input class="form-control" name="price_max" placeholder="До" value="{{ request('price_max') }}">
                </div>
                <div class="mb-3">
                    <select name="federalDistrictsFil" id="federalDistrictsFil" class="form-select">
                        <option value="">Все</option>
                        @foreach($federalDistricts as $id => $name)
                            <option value="{{ $id }}" {{ request('federalDistrictsFil') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <select name="regionsFil" id="regionsFil" class="form-select">
                        <option value="">Все</option>
                        @foreach($regions as $id => $name)
                            <option value="{{ $id }}" {{ request('regionsFil') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <select name="citiesFil" id="citiesFil" class="form-select">
                        <option value="">Все</option>
                        @foreach($cities as $id => $name)
                            <option value="{{ $id }}" {{ request('citiesFil') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-search">Применить</button>
            </form>
        </div>
    </div>
</div>

<div class="news-section">
    <div class="container">
        <h1>Новости</h1>
        <div class="cards-news">
            @foreach($news as $new)
                <div class="news-card" onclick="openNews({{ $new->id }})">
                    <img src="{{ asset('public/storage/' . $new->imagePath) }}" class="card-img-top" alt="Новость">
                    <div class="card-body">
                        <h4 class="card-title">{{ $new->title }}</h4>
                    </div>
                </div>
                <div class="news-overlay" id="overlay-{{ $new->id }}">
                    <div class="news-popup">
                        <button class="close-overlay" onclick="closeNews({{ $new->id }})">×</button>
                        <h2>{{ $new->title }}</h2>
                        <img src="{{ asset('public/storage/' . $new->imagePath) }}" alt="Новость">
                        <p>{{ $new->main_text }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="reviews-section">
    <div class="container">
        <div class="reviews-container">
            <h1>Отзывы</h1>
            <div class="cards-reviews">
                @foreach($reviews as $review)
                    <div class="review-card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $review->user->FIO }}</h3>
                            <p class="card-text">{{ $review->textReview }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function openNews(id) {
        document.getElementById(`overlay-${id}`).classList.add('active');
    }

    function closeNews(id) {
        document.getElementById(`overlay-${id}`).classList.remove('active');
    }

    document.querySelectorAll('.news-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                overlay.classList.remove('active');
            }
        });
    });
</script>
