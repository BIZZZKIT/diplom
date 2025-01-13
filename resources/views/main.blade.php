<style>
    .formSearch {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        background-image: url('{{asset('assets/images/forformmain.jpg')}}');
        background-size: cover;
        background-position: center;
        height: 704px;
        color: white;
    }

    .formSearch .container form {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .formSearch .container form .btn {
        color: black;
        border: none;
        background-color: #FFC300;
        grid-column: 2 / span 2;
    }


    .formSearch::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.73);
        z-index: 1;
    }

    .formSearch .container {
        position: relative;
        z-index: 2;
    }

    .cards_news {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px; /* Добавим промежуток между карточками */
        justify-content: center;
        justify-items: center; /* Добавим это свойство */
    }

    .cards_reviews {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px; /* Добавим промежуток между карточками */
        justify-content: center;
        justify-items: center; /* Добавим это свойство */
    }


</style>
{{--@php--}}
{{--    $cities = session('cities');--}}
{{--        $regions = session('regions');--}}
{{--        $federalDistricts = session('federalDistricts');--}}
{{--@endphp--}}
<div class="container">
    @if(session('success'))
        <div
            class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
            style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    @endif
    <div id="carouselExample" class="carousel slide"
         style="border-radius: 20px; padding-top: 57px; padding-bottom: 58px;">
        <div class="carousel-inner" style="border-radius: 20px; overflow: hidden; max-height: 670px;">
            <div class="carousel-item active">
                <img src="{{asset('assets/images/carousel/2f6865a8366bde9d6401bf8877276e7e2e6feb8c.png')}}"
                     class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/images/carousel/chelyabinsk_manhatten.png')}}" class="d-block w-100"
                     alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/images/carousel/ярославский.png')}}" class="d-block w-100" alt="...">
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
<div class="formSearch" style="padding-bottom: 200px; padding-top: 200px;">
    <div class="container">
        <h1 style="padding-bottom: 30px;  ">Найди свою мечту</h1>
        <form action="{{ route('catalog.filter') }}" method="GET"
              style="font-family: 'Roboto'; font-weight: normal;">
            <div class="mb-3">
                <select class="form form-select" name="type">
                    <option value="">Все</option>
                    <option value="Продажа" {{ request('typeOfSell') == 'Продажа' ? 'selected' : '' }}>Продажа
                    </option>
                    <option value="Аренда" {{ request('typeOfSell') == 'Аренда' ? 'selected' : '' }}>Аренда
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <select class="form form-select" name="category">
                    <option value="">Все</option>
                    <option value="Квартира" {{ request('flatOrHouse') == 'Квартира' ? 'selected' : '' }}>
                        Квартира
                    </option>
                    <option value="Дом" {{ request('flatOrHouse') == 'Дом' ? 'selected' : '' }}>Дом</option>
                </select>
            </div>
            <div class="mb-3">
                <input class="form-control" name="count_room" placeholder="Кол-во комнат"
                       value="{{ request('count_room') }}">
            </div>
            <div class="mb-3">
                <input class="form-control" name="price_min" placeholder="От"
                       value="{{ request('price_min') }}">
            </div>
            <div class="mb-3">
                <input class="form-control" name="price_max" placeholder="До"
                       value="{{ request('price_max') }}">
            </div>
            <div class="mb-3">
                <select name="federalDistrictsFil" id="federalDistrictsFil" class="form form-select">
                    <option value="">Все</option>
                    @foreach($federalDistricts as $id => $name)
                        <option
                            value="{{ $id }}" {{ request('federalDistrictsFil') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select name="regionsFil" id="regionsFil" class="form form-select">
                    <option value="">Все</option>
                    @foreach($regions as $id => $name)
                        <option
                            value="{{ $id }}" {{ request('regionsFil') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select name="citiesFil" id="citiesFil" class="form form-select">
                    <option value="">Все</option>
                    @foreach($cities as $id => $name)
                        <option
                            value="{{ $id }}" {{ request('citiesFil') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Применить</button>
        </form>
    </div>
</div>
<div class="news_container" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <h1>Новости</h1>
        </div>
        <div class="cards_news">
            @foreach($news as $new)
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('storage/' . $new->imagePath)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title">{{$new->title}}</h3>
                        <p class="card-text">{{$new->main_text}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="reviews_container"
     style="position: relative; background-image: url('{{asset('assets/images/backgroundReviews.png')}}'); background-size: cover; background-position: center; padding: 50px 0;">
    <div
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>

    <div class="container" style="position: relative; z-index: 2; color: white;">
        <div class="d-flex justify-content-center align-items-center">
            <h1>Отзывы</h1>
        </div>
        <div class="cards_reviews d-flex flex-wrap justify-content-center gap-3 mt-4">
            @foreach($reviews as $review)
                <div class="card"
                     style="width: 18rem; background-color: rgba(255, 255, 255, 0.8); border: none; border-radius: 10px;">
                    <div class="card-body">
                        <h3 class="card-title" style="color: black;">{{$review->user->FIO}}</h3>
                        <p class="card-text" style="color: black;">{{$review->textReview}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>



