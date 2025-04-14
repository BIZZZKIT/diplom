@php use Illuminate\Support\Facades\Auth; @endphp
<style>
    input, textarea {
        box-shadow: 0 0.25rem 0.5rem rgba(255, 195, 0, 0.5);
        border: 1px solid rgba(255, 195, 0, 0.8);
    }

    .modal-body input:focus, .modal-body textarea:focus {
        box-shadow: 0 0.5rem 1rem rgba(255, 195, 0, 0.8);
        border-color: #FFC300;
        outline: none;
    }

    .cards {
        padding-top: 94px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .formSearch {
        padding-top: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        background-size: cover;
        background-position: center;
        color: white;
    }

    .formSearch .container form {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
    }

    .formSearch .container form .btn {
        color: black;
        border: none;
        background-color: #FFC300;
        grid-column: 4 / span 2;
        grid-row: 2;
    }


    .formSearch .container {
        position: relative;
        z-index: 2;
    }
</style>

@extends('welcome')
@section('title', 'Каталог')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Находим форму и создаем контейнер для панорам
            const $form = $('form[action="{{route('createPremise')}}"]');
            const $panoramaContainer = $('<div>', {
                id: 'panorama-container',
                class: 'mb-3'
            });

            // Вставляем контейнер перед футером модального окна
            $form.find('.modal-footer').before($panoramaContainer);

            // Создаем кнопку для добавления панорамы (центрированную)
            const $addPanoramaBtn = $('<button>', {
                type: 'button',
                class: 'btn btn-yellow mb-3 d-block mx-auto',
                css: {
                    'background-color': '#FFC300'
                },
                text: 'Добавить панораму'
            });

            // Вставляем кнопку перед контейнером панорам
            $panoramaContainer.before($addPanoramaBtn);

            // Счетчик для уникальных ID
            let panoramaCount = 0;

            // Обработчик клика по кнопке добавления панорамы
            $addPanoramaBtn.on('click', function() {
                panoramaCount++;

                // Создаем контейнер для панорамы
                const $panoramaDiv = $('<div>', {
                    class: 'panorama-item mb-3 p-3',
                    css: {
                        'border': '1px solid #FFC300',
                        'border-radius': '5px'
                    }
                });

                // Добавляем поле для названия комнаты
                const $roomNameLabel = $('<label>', {
                    class: 'form-label',
                    text: 'Название комнаты',
                    'for': `room_name_${panoramaCount}`
                });

                const $roomNameInput = $('<input>', {
                    type: 'text',
                    class: 'form-control mb-2',
                    id: `room_name_${panoramaCount}`,
                    name: `panoramas[${panoramaCount}][room_name]`,
                    required: true
                });

                // Добавляем поле для загрузки панорамы
                const $panoramaLabel = $('<label>', {
                    class: 'form-label',
                    text: 'Фотография панорамы',
                    'for': `panorama_photo_${panoramaCount}`
                });

                const $panoramaInput = $('<input>', {
                    type: 'file',
                    class: 'form-control mb-2',
                    id: `panorama_photo_${panoramaCount}`,
                    name: `panoramas[${panoramaCount}][photo]`,
                    accept: 'image/*',
                    required: true
                });

                // Добавляем кнопку удаления панорамы
                const $removeBtn = $('<button>', {
                    type: 'button',
                    class: 'btn btn-danger btn-sm',
                    text: 'Удалить'
                }).on('click', function() {
                    $panoramaDiv.remove();
                });

                // Собираем все элементы вместе
                $panoramaDiv.append(
                    $roomNameLabel,
                    $roomNameInput,
                    $panoramaLabel,
                    $panoramaInput,
                    $removeBtn
                );

                // Добавляем в контейнер
                $panoramaContainer.append($panoramaDiv);
            });
        });
    </script>
    <div class="container">
        @if(session('successPremiseCreate'))
            <div
                class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
                style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
                {{ session('successPremiseCreate') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
        @if(session('reportSend'))
            <div
                class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
                style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
                {{ session('reportSend') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
        @if(session('savedPremiseExist'))
            <div
                class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
                style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
                {{ session('savedPremiseExist') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
        @if(session('savedPremiseCreated'))
            <div
                class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
                style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
                {{ session('savedPremiseCreated') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
        @if(Auth::check() && !Auth::user()->is_blocked)
            <div class="d-flex justify-content-center align-items-center">
                <button type="button" class="btn btn-yellow" data-bs-toggle="modal"
                        style="background-color: #FFC300; border: none" data-bs-target="#exampleModal">
                    Добавить недвижимость
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color: black;">
                            <div class="modal-header" style="border-bottom-color: #FFC300">
                                <h1 class="modal-title fs-5" style="font-family: Montserrat" id="exampleModalLabel">
                                    Добавление недвижимости</h1>
                                <button style="background-color: white" type="button" class="btn-close"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{route('createPremise')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Цена</label>
                                        <input type="number" step="0.01"
                                               class="form-control @error('price') is-invalid @enderror" id="price"
                                               name="price" required>
                                        @error('price')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="count_room" class="form-label">Кол-во комнат</label>
                                        <input type="number"
                                               class="form-control @error('count_room') is-invalid @enderror"
                                               id="count_room" name="count_room" required>
                                        @error('count_room')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="square" class="form-label">Площадь (м²)</label>
                                        <input type="number" step="0.01"
                                               class="form-control @error('square') is-invalid @enderror" id="square"
                                               name="square" required>
                                        @error('square')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="typeOfSell" class="form-label">Тип продажи</label>
                                        <select class="form-select @error('typeOfSell') is-invalid @enderror"
                                                id="typeOfSell" name="typeOfSell" required>
                                            <option value="Аренда">Аренда</option>
                                            <option value="Продажа">Продажа</option>
                                        </select>
                                        @error('typeOfSell')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3" id="district_block">
                                        <label for="district" class="form-label">Федеральный округ</label>
                                        <select name="district_id" id="district_id" class="form form-select">
                                            <option>Выберите федеральный округ</option>
                                            @foreach($federalDistricts as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3" id="region_block" style="display: none">
                                        <label for="region_id" class="form-label">Регион</label>
                                        <select name="region_id" id="region_id" class="form form-select">
                                            @foreach($regions as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3" id="city_block" style="display: none">
                                        <label for="city" class="form-label">Город</label>
                                        <select name="city_id" id="city_id" class="form form-select">
                                            @foreach($cities as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="flatOrHouse" class="form-label">Тип объекта</label>
                                        <select class="form-select @error('flatOrHouse') is-invalid @enderror"
                                                id="flatOrHouse" name="flatOrHouse" required>
                                            <option value="Квартира">Квартира</option>
                                            <option value="Дом">Дом</option>
                                        </select>
                                        @error('flatOrHouse')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Адрес</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                               id="address" name="address" required>
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="photos" class="form-label">Фотографии</label>
                                        <input type="file" class="form-control @error('photos') is-invalid @enderror"
                                               id="photos" name="photos[]" multiple required>
                                        @error('photos')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Описание</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  name="description" id="description" rows="5" required></textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal-footer" style="border-top-color: #FFC300">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть
                                    </button>
                                    <button type="submit" class="btn btn-yellow" style="background-color: #FFC300">
                                        Сохранить
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="formSearch">
            <div class="container">
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
                    <a href="{{route('catalog')}}">
                        <button type="button" class="btn btn-primary">Сбросить фильтры</button>
                    </a>
                </form>
            </div>
        </div>

        <div class="cards" style="padding-bottom: 50px;">
            @foreach($premises as $premise)
                @php
                    $imagePaths = $premise->images->pluck('path')->toArray();
                @endphp
                @if($premise->deletedForReason === null && $premise->bannedOwner === null)
                    @include('components.card', array('imagePaths' => $imagePaths, 'premise' => $premise))
                @endif
            @endforeach
        </div>
    </div>
@endsection
