@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
@endphp

<style>
    .card {
        width: 26.125rem;
        border-radius: 12px;
        background-color: #1a1a1a;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative; /* Ensure card transforms don't affect modals */
    }

    .card:hover {
        box-shadow: 0 6px 16px rgba(255, 195, 0, 0.3);
        border: 1px solid #FFC300;
    }

    .carousel-inner {
        border-radius: 12px;
    }

    .carousel-item img {
        height: 255px;
        object-fit: cover;
        border-radius: 12px;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 10%;
        border-radius: 12px;
    }


    .card-body {
        padding: 1.5rem;
        color: white;
        font-family: 'Roboto', sans-serif;
    }

    .card-text {
        margin-bottom: 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
    }

    .card-text:first-child {
        font-size: 1.25rem;
        font-weight: bold;
        color: #FFC300;
    }

    .card-body .btn {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .card-body .btn:hover {
        transform: translateY(-2px);
    }

    .btn-warning {
        background-color: #FFC300;
        color: black;
        border: none;
    }

    .btn-warning:hover {
        background-color: #FFD700;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-secondary {
        background-color: #555;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #666;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .modal {
        z-index: 1055; /* Higher z-index to ensure modals are above all content */
    }

    .modal-backdrop {
        z-index: 1050; /* Ensure backdrop is below modal but above other content */
    }

    .modal-content {
        border-radius: 12px;
        background-color: #1a1a1a;
        position: relative; /* Prevent parent transforms from affecting modal */
    }

    .modal.fade .modal-dialog {
        transition: opacity 0.3s ease-out;
        transform: none !important; /* Disable transform to prevent jerking */
        opacity: 0;
    }

    .modal.show .modal-dialog {
        opacity: 1;
    }

    .modal-body input,
    .modal-body select,
    .modal-body textarea {
        background-color: #333;
        color: white;
        border: 1px solid #555;
        border-radius: 6px;
        padding: 0.75rem;
    }

    .modal-body input:focus,
    .modal-body select:focus,
    .modal-body textarea:focus {
        border-color: #FFC300;
        box-shadow: 0 0 8px rgba(255, 195, 0, 0.5);
        outline: none;
    }

    .modal-footer {
        border-top: 1px solid #FFC300;
    }
</style>

<div class="card">
    @if(!empty($imagePaths))
        <a href="{{ route('premiseItem', ['premiseId' => $premise->id]) }}">
            <div id="carousel-{{ $premise->id }}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($imagePaths as $index => $path)
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
        </a>
    @endif
    <div class="card-body">
        <p class="card-text">{{ number_format($premise->price, 0, ',', ' ') }} ₽</p>
        <p class="card-text">{{ $premise->count_room }}-комн квартира {{ $premise->square }} м²</p>
        <p class="card-text">{{ $premise->federalDistricts->name }}, {{ $premise->regions->name }}, {{ $premise->cities->name }}, {{ $premise->address }}</p>

        @if(Route::is('reports'))
            <div class="btn btn-secondary">{{ $report->statuses }}</div>
        @endif

        @if(Auth::check() && !Route::is('reports'))
            @if(!Route::is('savedPremises') && !Route::is('yourPremises') && !Route::is('admin') && !Route::is('yoursReports'))
                <form method="post" action="{{ route('savePremise', ['premiseId' => $premise->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-warning">Сохранить</button>
                </form>
            @endif

            @if(Route::is('savedPremises'))
                <form method="post" action="{{ route('deleteSavedPremise', ['premiseId' => $premise->id]) }}">
                    @csrf
                    @method('POST') <!-- Corrected to DELETE -->
                    <button type="submit" class="btn btn-warning">Удалить из сохранённых</button>
                </form>
            @elseif(Route::is('yourPremises'))
                @if($premise->deletedForReason === null && $premise->bannedOwner === null)
                    <form method="post" action="{{ route('deleteYourPremise', ['premiseId' => $premise->id]) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning">Удалить из каталога</button>
                    </form>
                    <button type="button" class="btn btn-warning edit-button" data-bs-toggle="modal" data-bs-target="#modal-{{ $premise->id }}">Редактировать</button>

                    <div class="modal fade" id="modal-{{ $premise->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $premise->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" style="color: white; font-family: Montserrat" id="modalLabel-{{ $premise->id }}">Изменение данных</h1>
                                    <button style="background-color: white" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('editYourPremise', ['premiseId' => $premise->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="price-{{ $premise->id }}" class="form-label">Цена</label>
                                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price-{{ $premise->id }}" name="price" required>
                                            @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="count_room-{{ $premise->id }}" class="form-label">Кол-во комнат</label>
                                            <input type="number" class="form-control @error('count_room') is-invalid @enderror" id="count_room-{{ $premise->id }}" name="count_room" required>
                                            @error('count_room')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="square-{{ $premise->id }}" class="form-label">Площадь (м²)</label>
                                            <input type="number" step="0.01" class="form-control @error('square') is-invalid @enderror" id="square-{{ $premise->id }}" name="square" required>
                                            @error('square')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="typeOfSell-{{ $premise->id }}" class="form-label">Тип продажи</label>
                                            <select class="form-select @error('typeOfSell') is-invalid @enderror" id="typeOfSell-{{ $premise->id }}" name="typeOfSell" required>
                                                <option value="Аренда">Аренда</option>
                                                <option value="Продажа">Продажа</option>
                                            </select>
                                            @error('typeOfSell')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3" id="district_block-{{ $premise->id }}">
                                            <label for="district_id-{{ $premise->id }}" class="form-label">Федеральный округ</label>
                                            <select name="district_id" class="form-select" id="district_id-{{ $premise->id }}">
                                                <option value="">Выберите федеральный округ</option>
                                                @foreach($federalDistricts as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3" id="region_block-{{ $premise->id }}" style="display: none;">
                                            <label for="region_id-{{ $premise->id }}" class="form-label">Регион</label>
                                            <select name="region_id" class="form-select" id="region_id-{{ $premise->id }}">
                                                <option value="">Выберите регион</option>
                                                @foreach($regions as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3" id="city_block-{{ $premise->id }}" style="display: none;">
                                            <label for="city_id-{{ $premise->id }}" class="form-label">Город</label>
                                            <select name="city_id" class="form-select" id="city_id-{{ $premise->id }}">
                                                <option value="">Выберите город</option>
                                                @foreach($cities as $name)
                                                    <option value="{{ $name }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="flatOrHouse-{{ $premise->id }}" class="form-label">Тип объекта</label>
                                            <select class="form-select @error('flatOrHouse') is-invalid @enderror" id="flatOrHouse-{{ $premise->id }}" name="flatOrHouse" required>
                                                <option value="Квартира">Квартира</option>
                                                <option value="House">Дом</option>
                                            </select>
                                            @error('flatOrHouse')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="address-{{ $premise->id }}" class="form-label">Адрес</label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address-{{ $premise->id }}" name="address" required>
                                            @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="photos-{{ $premise->id }}" class="form-label">Фотографии</label>
                                            <input type="file" class="form-control @error('photos') is-invalid @enderror" id="photos-{{ $premise->id }}" name="photos[]" multiple>
                                            @error('photos')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="description-{{ $premise->id }}" class="form-label">Описание</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description-{{ $premise->id }}" name="description" rows="5" required></textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                        <button type="submit" class="btn btn-warning">Сохранить изменения</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <button class="btn btn-danger">Удалено по причине: @if ($premise->bannedOwner !== null) Пользователь banned @elseif ($premise->deletedForReason !== null) {{ $premise->deletedForReason }} @endif</button>
                @endif
            @elseif(Route::is('yoursReports'))
                @if($report->statuses == 'Решено')
                    <button class="btn btn-success">{{ $report->statuses }}</button>
                @elseif($report->statuses == 'Отклонена')
                    <button class="btn btn-danger">{{ $report->statuses }}</button>
                @elseif($report->statuses == 'На рассмотрении')
                    <button class="btn btn-secondary">{{ $report->statuses }}</button>
                @endif
            @endif

            @if(Auth::id() && Auth::id() !== $premise->user_id && !Route::is('admin') && !Route::is('yoursReports'))
                <button type="button" class="btn btn-danger report-button" data-bs-toggle="modal" data-bs-target="#reportModal-{{ $premise->id }}">Пожаловаться</button>

                <div class="modal fade" id="reportModal-{{ $premise->id }}" tabindex="-1" aria-labelledby="reportModalLabel-{{ $premise->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" style="font-family: Montserrat; color: white" id="reportModalLabel-{{ $premise->id }}">Жалоба</h1>
                                <button style="background-color: white" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('createReport', ['premiseId' => $premise->id]) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="reportText-{{ $premise->id }}" class="form-label">Описание</label>
                                        <textarea class="form-control" name="reportText" id="reportText-{{ $premise->id }}" rows="5" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="photos-report-{{ $premise->id }}" class="form-label">Доказательства</label>
                                        <div class="custom-file-input" style="margin-top: 8px;">
                                            <input type="file"
                                                   class="form-control @error('photos') is-invalid @enderror"
                                                   id="photos-report-{{ $premise->id }}"
                                                   name="photos[]"
                                                   multiple>
                                            <label for="photos-report-{{ $premise->id }}" class="file-label">
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
                                        document.getElementById('photos-report-{{ $premise->id }}').addEventListener('change', function (e) {
                                            var fileName = '';
                                            if (this.files && this.files.length > 1) {
                                                fileName = (this.getAttribute('data-multiple-caption') || '{count} файлов выбрано').replace('{count}', this.files.length);
                                            } else {
                                                fileName = e.target.value.split('\\').pop();
                                            }
                                            if (fileName) {
                                                document.querySelector('.file-name').textContent = fileName;
                                            } else {
                                                document.querySelector('.file-name').textContent = '';
                                            }
                                        });
                                    </script>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                    <button type="submit" class="btn btn-yellow" style="background-color: #FFC300">Отправить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
