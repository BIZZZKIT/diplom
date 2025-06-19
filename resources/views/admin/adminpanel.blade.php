@extends('welcome')
@section('title', 'Панель администратора')
@section('content')
    <style>
        /* Общие стили */
        body {
            background-color: #1a1a1a;
            color: #ddd;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
        }

        /* Уведомления */
        .alert-success {
            position: fixed;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f6ebc0;
            color: #FFC300;
            border: none;
            border-radius: 6px;
            padding: 0.75rem;
            z-index: 1050;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 0.85rem;
        }

        .alert-success .btn-close {
            background-color: transparent;
            border: none;
            font-size: 0.8rem;
        }

        /* Кнопки */
        .btn-yellow,
        .btn-warning {
            background-color: #FFC300;
            color: black;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-yellow:hover,
        .btn-warning:hover {
            background-color: #FFD700;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        /* Таблица */
        .admin-table {
            background-color: #222 !important;
            border: 1px solid #444;
            border-radius: 8px;
            overflow: hidden;
            margin: 20px 0;
            width: 100%;
            table-layout: fixed;
        }

        .admin-table thead {
            background-color: #333;
        }

        .admin-table th,
        .admin-table td {
            border: 1px solid #444;
            padding: 0.5rem;
            text-align: center;
            vertical-align: middle;
            font-size: 0.85rem;
            color: #ddd !important;
        }

        .admin-table th {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .admin-table tbody tr {
            transition: background-color 0.3s ease;
        }

        .admin-table tbody tr:hover {
            background-color: #2a2a2a;
        }

        /* Исключение для колонки Объявление */
        .admin-table td:not(.announcement),
        .admin-table th:not(.announcement) {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .admin-table .announcement {
            overflow: visible;
            white-space: normal;
        }

        /* Ссылка на объявление */
        .announcement-link {
            color: #FFC300 !important;
            background-color: rgba(255, 195, 0, 0.1);
            text-decoration: underline;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.25rem;
            display: inline-block;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .announcement-link:hover {
            color: #FFD700 !important;
            background-color: rgba(255, 215, 0, 0.2);
            text-decoration: underline;
        }

        /* Картинки доказательств */
        .proof-thumbnails {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            justify-content: center;
        }

        .proof-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .proof-thumbnail:hover {
            transform: scale(1.05);
        }

        /* Модальное окно для просмотра доказательств */
        .proof-modal .modal-content {
            background-color: #222;
            border-radius: 8px;
        }

        .proof-modal .modal-header {
            border-bottom: 1px solid #FFC300;
            padding: 0.75rem;
        }

        .proof-modal .modal-title {
            color: #FFC300;
            font-size: 1.1rem;
        }

        .proof-modal .btn-close {
            background-color: #fff;
            border-radius: 50%;
            padding: 4px;
        }

        .proof-modal .modal-body {
            text-align: center;
            padding: 1rem;
        }

        .proof-modal .carousel {
            max-width: 100%;
        }

        .proof-modal .carousel-inner img {
            max-height: 400px;
            object-fit: contain;
            border-radius: 6px;
            margin: 0 auto;
        }

        /* Модальные окна */
        .modal-content {
            background-color: #222;
            border-radius: 8px;
            border: none;
        }

        .modal-header {
            border-bottom: 1px solid #FFC300;
            padding: 0.75rem;
        }

        .modal-title {
            color: #FFC300;
            font-size: 1.1rem;
        }

        .modal-footer {
            border-top: 1px solid #FFC300;
            padding: 0.75rem;
        }

        .form-control,
        .form-select,
        textarea.form-control {
            background-color: #333;
            border: 1px solid #444;
            border-radius: 6px;
            color: white;
            padding: 0.5rem;
            font-size: 0.85rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus,
        textarea.form-control:focus {
            border-color: #FFC300;
            box-shadow: 0 0 8px #FFC300;
            outline: none;
        }

        .form-control::placeholder,
        textarea.form-control::placeholder {
            color: white;
            opacity: 1;
        }

        .form-label {
            color: #ddd;
            font-size: 0.85rem;
        }

        /* Кастомный input для загрузки файла */
        .custom-file-input {
            position: relative;
            width: 100%;
            margin-top: 8px;
        }

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
            width: 100%;
        }

        .file-button {
            background-color: #FFC300;
            color: black;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .file-button:hover {
            background-color: #FFD700;
            transform: translateY(-2px);
        }

        .file-name {
            color: #ddd;
            margin-left: 10px;
            font-size: 0.85rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .preview-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 4px;
            margin-top: 0.5rem;
            border: 1px solid #444;
            display: none;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.8rem;
        }

        /* Адаптивность */
        @media (max-width: 576px) {
            body {
                font-size: 0.8rem;
            }

            .admin-table th,
            .admin-table td {
                font-size: 0.8rem;
                padding: 0.4rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 5px;
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            .announcement-link {
                font-size: 0.8rem;
                padding: 0.2rem;
            }

            .proof-thumbnail {
                width: 50px;
                height: 50px;
            }

            .proof-modal .carousel-inner img {
                max-height: 300px;
            }

            .modal-title {
                font-size: 1rem;
            }

            .form-control,
            textarea.form-control {
                font-size: 0.8rem;
            }

            .form-label {
                font-size: 0.8rem;
            }

            .file-button {
                font-size: 0.8rem;
                padding: 6px 12px;
            }

            .file-name {
                font-size: 0.8rem;
            }

            .preview-image {
                max-width: 80px;
                max-height: 80px;
            }
        }
    </style>

    <div class="container">
        @if(session('successNewsCreate'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('successNewsCreate') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
        @if(session('successDeleteFromCatalog'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('successDeleteFromCatalog') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif

        <div class="d-flex justify-content-center align-items-center mb-3 gap-2">
            <form action="{{ route('reviews') }}">
                @csrf
                <button type="submit" class="btn btn-warning">Отзывы</button>
            </form>
            <button type="button" class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Добавить новость
            </button>
        </div>

        <!-- Модальное окно для добавления новости -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление новости</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('createNews') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="title" class="form-label">Заголовок новости</label>
                                <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Заголовок новости">
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="mainText" class="form-label">Основной текст новости</label>
                                <textarea class="form-control @error('mainText') is-invalid @enderror" name="mainText" id="mainText" rows="4" required></textarea>
                                @error('mainText')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="photo" class="form-label">Фотография</label>
                                <div class="custom-file-input">
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*" required>
                                    <label for="photo" class="file-label">
                                        <span class="file-button">Выбрать файл</span>
                                        <span class="file-name"></span>
                                    </label>
                                    @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <img class="preview-image" src="#" alt="Предпросмотр" style="display: none;">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-yellow">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center mb-3">
            <h1 style="font-size: 1.5rem;">Жалобы на пользователей/объявления</h1>
        </div>

        <table class="admin-table">
            <thead>
            <tr>
                <th scope="col" style="width: 5%;">ID</th>
                <th scope="col">ФИО кто пожаловался</th>
                <th scope="col" class="announcement">Объявление</th>
                <th scope="col">Владелец объявления</th>
                <th scope="col">Причина жалобы</th>
                <th scope="col">Доказательства</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
                <tr>
                    <td title="{{ $report->id }}">{{ $report->id }}</td>
                    <td title="{{ $report->userSender->FIO }}">{{ $report->userSender->FIO }}</td>
                    <td class="announcement">
                        <a href="{{ route('premiseItem', $report->premise->id) }}" class="announcement-link">
                            Просмотреть объявление #{{ $report->premise->id }}
                        </a>
                    </td>
                    <td title="{{ $report->premise->user->FIO }}">{{ $report->premise->user->FIO }}</td>
                    <td title="{{ $report->textOfReport }}">{{ $report->textOfReport }}</td>
                    <td>
                        @php
                            $imagePathsProofs = $report->imagesProofs->pluck('path')->toArray();
                        @endphp
                        <div class="proof-thumbnails">
                            @foreach($imagePathsProofs as $index => $path)
                                <img src="{{ asset('public/storage/' . $path) }}"
                                     class="proof-thumbnail"
                                     data-bs-toggle="modal"
                                     data-bs-target="#proofModal-{{ $report->id }}"
                                     data-index="{{ $index }}"
                                     alt="Proof {{ $index + 1 }}">
                            @endforeach
                        </div>
                    </td>
                    <td>
                        @if($report->premise->deletedForReason === null && $report->premise->bannedOwner === null && $report->statuses === 'На рассмотрении')
                            <div class="d-flex flex-column gap-1">
                                <button type="button" class="btn btn-yellow" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $report->id }}">
                                    Удалить
                                </button>
                                <form method="POST" action="{{ route('banUser', ['userId' => $report->premise->user_id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Бан</button>
                                </form>
                                <form method="POST" action="{{ route('changeStatusDenied', ['reportId' => $report->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Отклонить</button>
                                </form>
                            </div>
                        @else
                            @if($report->statuses === 'Решено')
                                <button class="btn btn-success">Решена</button>
                            @elseif($report->statuses === 'Отклонена')
                                <button class="btn btn-danger">Отклонено</button>
                            @endif
                        @endif
                    </td>
                </tr>

                <!-- Модальное окно для просмотра доказательств -->
                <div class="modal fade proof-modal" id="proofModal-{{ $report->id }}" tabindex="-1"
                     aria-labelledby="proofModalLabel-{{ $report->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="proofModalLabel-{{ $report->id }}">Доказательства жалобы #{{ $report->id }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="proofCarousel-{{ $report->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($imagePathsProofs as $index => $path)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('public/storage/' . $path) }}"
                                                     class="d-block w-100"
                                                     alt="Proof {{ $index + 1 }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                            data-bs-target="#proofCarousel-{{ $report->id }}"
                                            data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                            data-bs-target="#proofCarousel-{{ $report->id }}"
                                            data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Модальное окно для удаления объявления -->
                <div class="modal fade" id="deleteModal-{{ $report->id }}" tabindex="-1"
                     aria-labelledby="deleteModalLabel-{{ $report->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteModalLabel-{{ $report->id }}">Удаление недвижимости</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('deletePremiseFromCatalog', ['premiseId' => $report->premise_id]) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label for="reason-{{ $report->id }}" class="form-label">Причина удаления</label>
                                        <textarea class="form-control" name="reason" id="reason-{{ $report->id }}"
                                                  rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                    <button type="submit" class="btn btn-yellow">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript для установки начального слайда в модальном окне доказательств
        document.querySelectorAll('.proof-thumbnail').forEach(thumbnail => {
            thumbnail.addEventListener('click', function () {
                const modalId = this.getAttribute('data-bs-target');
                const index = parseInt(this.getAttribute('data-index'));
                const carousel = document.querySelector(`${modalId} .carousel`);
                const carouselItems = carousel.querySelectorAll('.carousel-item');
                carouselItems.forEach(item => item.classList.remove('active'));
                carouselItems[index].classList.add('active');
            });
        });

        // Предпросмотр изображения
        document.getElementById('photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const fileNameSpan = document.querySelector('.file-name');
            const preview = document.querySelector('.preview-image');

            // Отображение имени файла
            if (file) {
                fileNameSpan.textContent = file.name;
            } else {
                fileNameSpan.textContent = '';
            }

            // Предпросмотр изображения
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
