@php
    use Illuminate\Support\Facades\Auth;
@endphp

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
        padding-bottom: 50px;
    }

    .formSearch {
        padding: 2rem;
        margin-top: 1.5rem;
    }

    .formSearch .container form {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
        font-family: 'Roboto', sans-serif;
        font-weight: normal;
    }

    .formSearch .container form select,
    .formSearch .container form input {
        width: 100%;
        padding: 0.75rem;
        border-radius: 4px;
        background-color: #333;
        color: white;
        border: 1px solid #FFC300;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .formSearch .container form select:focus,
    .formSearch .container form input:focus {
        border-color: #FFD700;
        box-shadow: 0 0 8px rgba(255, 215, 0, 0.5);
        outline: none;
    }

    .formSearch .container form input::placeholder {
        color: #aaa;
    }

    .formSearch .container form .btn {
        border-radius: 4px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .formSearch .container form .btn-primary {
        background-color: #FFC300;
        color: black;
    }

    .formSearch .container form .btn-primary:hover {
        background-color: #FFD700;
    }

    .formSearch .container form .btn-secondary {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #555;
        color: white;
    }

    .formSearch .container form .btn-secondary:hover {
        background-color: #666;
    }

    @media (max-width: 768px) {
        .formSearch .container form {
            grid-template-columns: 1fr;
        }

        .formSearch .container form .btn {
            grid-column: span 1;
        }
    }
</style>

@extends('welcome')
@section('title', 'Каталог')
@section('content')
    <script>
        $(document).ready(function () {
            const $form = $('form[action="{{route('createPremise')}}"]');
            const $panoramaContainer = $('<div>', {
                id: 'panorama-container',
                class: 'mb-3'
            });

            $form.find('.modal-footer').before($panoramaContainer);

            const $addPanoramaBtn = $('<button>', {
                type: 'button',
                class: 'btn btn-yellow mb-3 d-block mx-auto',
                css: {
                    'background-color': '#FFC300'
                },
                text: 'Добавить панораму'
            });

            $panoramaContainer.before($addPanoramaBtn);

            let panoramaCount = 0;

            $addPanoramaBtn.on('click', function () {
                panoramaCount++;

                const $panoramaDiv = $('<div>', {
                    class: 'panorama-item mb-3 p-3',
                    css: {
                        'border': '1px solid #FFC300',
                        'border-radius': '5px'
                    }
                });

                const $roomNameLabel = $('<label>', {
                    class: 'form-label',
                    text: 'Название комнаты',
                    'for': `room_name_${panoramaCount}`,
                });

                const $roomNameInput = $('<input>', {
                    type: 'text',
                    class: 'form-control mb-2',
                    id: `room_name_${panoramaCount}`,
                    name: `panoramas[${panoramaCount}][room_name]`,
                    required: true,
                    css: {
                        'background-color': '#333',
                        'color': 'white',
                        'border-color': '#555'
                    }
                });

                const $panoramaLabel = $('<label>', {
                    class: 'form-label',
                    text: 'Фотография панорамы',
                    'for': `panorama_photo_${panoramaCount}`
                });

                const $fileInputWrapper = $('<div>', {class: 'custom-file-input mb-2'});

                const $panoramaInput = $('<input>', {
                    type: 'file',
                    class: 'form-control',
                    id: `panorama_photo_${panoramaCount}`,
                    name: `panoramas[${panoramaCount}][photo]`,
                    accept: 'image/*',
                    required: true
                }).css({
                    width: '0.1px',
                    height: '0.1px',
                    opacity: 0,
                    overflow: 'hidden',
                    position: 'absolute',
                    zIndex: -1
                });

                const $fileLabel = $('<label>', {
                    class: 'file-label',
                    for: `panorama_photo_${panoramaCount}`,
                    css: {display: 'flex', alignItems: 'center'}
                });

                const $fileButton = $('<span>', {
                    class: 'file-button',
                    text: 'Выбрать файлы',
                    css: {
                        backgroundColor: '#FFC300',
                        color: 'black',
                        padding: '8px 16px',
                        borderRadius: '4px',
                        cursor: 'pointer'
                    }
                });

                const $fileName = $('<span>', {
                    class: 'file-name',
                    css: {
                        color: 'white',
                        marginLeft: '10px'
                    }
                });

                $fileLabel.append($fileButton, $fileName);
                $fileInputWrapper.append($panoramaInput, $fileLabel);

                const $removeBtn = $('<button>', {
                    type: 'button',
                    class: 'btn btn-danger btn-sm mt-2',
                    text: 'Удалить'
                }).on('click', function () {
                    $panoramaDiv.remove();
                });

                $panoramaDiv.append(
                    $roomNameLabel,
                    $roomNameInput,
                    $panoramaLabel,
                    $fileInputWrapper,
                    $removeBtn
                );

                $panoramaContainer.append($panoramaDiv);
            });

            $(document).on('change', 'input[type="file"]', function (e) {
                const fileName = this.files.length > 1
                    ? `Выбрано файлов: ${this.files.length}`
                    : e.target.value.split('\\').pop();
                $(this).siblings('label').find('.file-name').text(fileName);
            });
        });
    </script>

    <div class="container">
        <!-- Success Alerts -->
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

        <!-- Add Premise Button and Modal -->
        @if(Auth::check() && !Auth::user()->is_blocked)
            <div class="d-flex justify-content-center align-items-center my-4">
                <button type="button" class="btn btn-yellow px-4 py-2" style="background-color: #FFC300; border: none"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                                               name="price"
                                               style="background-color: #333; color: white; border-color: #555;">
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="count_room" class="form-label">Кол-во комнат</label>
                                        <input type="number"
                                               class="form-control @error('count_room') is-invalid @enderror"
                                               id="count_room" name="count_room"
                                               style="background-color: #333; color: white; border-color: #555;">
                                        @error('count_room')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="square" class="form-label">Площадь (м²)</label>
                                        <input type="number" step="0.01"
                                               class="form-control @error('square') is-invalid @enderror" id="square"
                                               name="square"
                                               style="background-color: #333; color: white; border-color: #555;">
                                        @error('square')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="typeOfSell" class="form-label">Тип продажи</label>
                                        <select class="form-select @error('typeOfSell') is-invalid @enderror"
                                                id="typeOfSell" name="typeOfSell" required
                                                style="background-color: #333; color: white; border-color: #555;">
                                            <option value="Аренда">Аренда</option>
                                            <option value="Продажа">Продажа</option>
                                        </select>
                                        @error('typeOfSell')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3" id="district_block">
                                        <label for="district_id" class="form-label">Федеральный округ</label>
                                        <select name="district_id" id="district_id" class="form form-select"
                                                style="background-color: #333; color: white; border-color: #555;">
                                            <option>Выберите федеральный округ</option>
                                            @foreach($federalDistricts as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3" id="region_block" style="display: none">
                                        <label for="region_id" class="form-label">Регион</label>
                                        <select name="region_id" id="region_id" class="form form-select"
                                                style="background-color: #333; color: white; border-color: #555;">
                                            @foreach($regions as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3" id="city_block" style="display: none">
                                        <label for="city_id" class="form-label">Город</label>
                                        <select name="city_id" id="city_id" class="form form-select"
                                                style="background-color: #333; color: white; border-color: #555;">
                                            @foreach($cities as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="flatOrHouse" class="form-label">Тип объекта</label>
                                        <select class="form-select @error('flatOrHouse') is-invalid @enderror"
                                                id="flatOrHouse" name="flatOrHouse" required
                                                style="background-color: #333; color: white; border-color: #555;">
                                            <option value="Квартира">Квартира</option>
                                            <option value="Дом">Дом</option>
                                        </select>
                                        @error('flatOrHouse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Адрес</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                               id="address" name="address"
                                               style="background-color: #333; color: white; border-color: #555;">
                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="photos" class="form-label">Фотографии</label>
                                        <div class="custom-file-input" style="margin-top: 8px;">
                                            <input type="file"
                                                   class="form-control @error('photos') is-invalid @enderror"
                                                   id="photos" name="photos[]" multiple>
                                            <label for="photos" class="file-label">
                                                <span class="file-button"
                                                      style="background-color: #FFC300; color: black; padding: 8px 16px; border-radius: 4px; cursor: pointer;">Выбрать файлы</span>
                                                <span class="file-name" style="color: white; margin-left: 10px;"></span>
                                            </label>
                                            @error('photos')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <style>
                                        .custom-file-input input[type="file"] {
                                            width: 0.1px;
                                            height: 0.1px;
                                            opacity: 0;
                                            overflow: hidden;
                                            position: absolute;
                                            z-index: -1;
                                        }

                                        .file-label {
                                            display: flex;
                                            align-items: center;
                                        }
                                    </style>

                                    <script>
                                        document.getElementById('photos').addEventListener('change', function (e) {
                                            var fileName = '';
                                            if (this.files && this.files.length > 1) {
                                                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                                            } else {
                                                fileName = e.target.value.split('\\').pop();
                                            }
                                            if (fileName) {
                                                document.querySelector('.file-name').textContent = fileName;
                                            }
                                        });
                                    </script>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Описание</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  name="description" id="description" rows="5"
                                                  style="background-color: #333; color: white; border-color: #555;"></textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
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

        <!-- Filter Form -->
        <div class="formSearch">
            <div class="container">
                <form action="{{ route('catalog.filter') }}" method="GET">
                    <div class="mb-3">
                        <select name="type" class="form-select">
                            <option value="">Все</option>
                            <option value="Продажа" {{ request('typeOfSell') == 'Продажа' ? 'selected' : '' }}>Продажа
                            </option>
                            <option value="Аренда" {{ request('typeOfSell') == 'Аренда' ? 'selected' : '' }}>Аренда
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="category" class="form-select">
                            <option value="">Все</option>
                            <option value="Квартира" {{ request('flatOrHouse') == 'Квартира' ? 'selected' : '' }}>
                                Квартира
                            </option>
                            <option value="Дом" {{ request('flatOrHouse') == 'Дом' ? 'selected' : '' }}>Дом</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input name="count_room" placeholder="Кол-во комнат" value="{{ request('count_room') }}"
                               class="form-control">
                    </div>
                    <div class="mb-3">
                        <input name="price_min" placeholder="От" value="{{ request('price_min') }}"
                               class="form-control">
                    </div>
                    <div class="mb-3">
                        <input name="price_max" placeholder="До" value="{{ request('price_max') }}"
                               class="form-control">
                    </div>
                    <div class="mb-3">
                        <select name="federalDistrictsFil" id="federalDistrictsFil" class="form-select">
                            <option value="">Все</option>
                            @foreach($federalDistricts as $id => $name)
                                <option
                                    value="{{ $id }}" {{ request('federalDistrictsFil') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="regionsFil" id="regionsFil" class="form-select">
                            <option value="">Все</option>
                            @foreach($regions as $id => $name)
                                <option
                                    value="{{ $id }}" {{ request('regionsFil') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="citiesFil" id="citiesFil" class="form-select">
                            <option value="">Все</option>
                            @foreach($cities as $id => $name)
                                <option
                                    value="{{ $id }}" {{ request('citiesFil') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Применить</button>
                    <a href="{{route('catalog')}}" class="btn btn-secondary">Сбросить фильтры</a>
                </form>
            </div>
        </div>

        <!-- Premises Cards -->
        <div class="cards">
            @foreach($premises as $premise)
                @php
                    $imagePaths = $premise->images->pluck('path')->toArray();
                @endphp
                @if($premise->deletedForReason === null && $premise->bannedOwner === null)
                    @include('components.card', ['imagePaths' => $imagePaths, 'premise' => $premise])
                @endif
            @endforeach
        </div>
    </div>
@endsection
