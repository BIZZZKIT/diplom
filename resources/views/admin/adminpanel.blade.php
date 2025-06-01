@extends('welcome')
@section('title', 'Панель администратора')
@section('content')
    <div class="container" style="margin-top: 50px;">
        @if(session('successNewsCreate'))
            <div
                class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
                style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
                {{ session('successNewsCreate') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
        @if(session('successDeleteFromCatalog'))
            <div
                class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
                style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
                {{ session('successDeleteFromCatalog') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
        <div class="d-flex justify-content-center align-items-center mb-4 gap-2">
            <form action="{{route('reviews')}}">
                @csrf
                <button type="submit" class="btn btn-warning">Отзывы</button>
            </form>
            <button type="button" class="btn btn-yellow" data-bs-toggle="modal"
                    style="background-color: #FFC300; border: none" data-bs-target="#exampleModal">
                Добавить новость
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: black;">
                        <div class="modal-header" style="border-bottom-color: #FFC300">
                            <h1 class="modal-title fs-5" style="font-family: Montserrat" id="exampleModalLabel">
                                Добавление новости</h1>
                            <button style="background-color: white" type="button" class="btn-close"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{route('createNews')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3" id="district_block">
                                    <label for="title" class="form-label">Заголовок новости</label>
                                    <input id="title" name="title" type="text" class="form-control"
                                           placeholder="Заголовок новости">
                                </div>

                                <div class="mb-3" id="district_block">
                                    <label for="mainText" class="form-label">Основной текст новости</label>
                                    <textarea class="form-control"
                                              name="mainText" id="mainText" rows="5" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="photo" class="form-label">Фотография</label>
                                    <input type="file" class="form-control"
                                           id="photo" name="photo" required>
                                </div>
                            </div>

                            <div class="modal-footer" style="border-top-color: #FFC300">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-yellow" style="background-color: #FFC300">
                                    Сохранить
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <h1>Жалобы на пользователей/объявления</h1>
        </div>
        <table class="table table-bordered " style="border-radius: 20px; overflow: hidden; margin: 50px;">
            <thead>
            <tr>
                <th scope="col">ФИО кто пожаловался</th>
                <th scope="col">Объявление</th>
                <th scope="col">Владелец объявления</th>
                <th scope="col">Причина жалобы</th>
                <th scope="col">Доказательства</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
                <tr>
                    <th scope="col">{{$report->userSender->FIO}}</th>
                    <th scope="col">
                        @php
                            $imagePaths = $report->premise->images->pluck('path')->toArray();
                            $imagePathsProofs = $report->imagesProofs->pluck('path')->toArray();
                        @endphp
                        @include('components.card', array('imagePaths' => $imagePaths, 'premise' => $report->premise))
                    </th>
                    <th scope="col">{{$report->premise->user->FIO}}</th>
                    <th scope="col">{{$report->textOfReport}}</th>
                    <th scope="col">
                        <div class="proof" style="width: 100%; max-width: 300px; height: auto;">
                            <div id="carousel-{{ $report->id }}-{{ $loop->index }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" style="border-radius: 20px">
                                    @foreach($imagePathsProofs as $index => $path)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $path) }}"
                                                 style="width: 100%; height: 200px; object-fit: cover;"
                                                 class="d-block w-100"
                                                 alt="Image {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                                @if(count($imagePathsProofs) > 1)
                                    <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carousel-{{ $report->id }}-{{ $loop->index }}"
                                            data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                            data-bs-target="#carousel-{{ $report->id }}-{{ $loop->index }}"
                                            data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </th>
                    <th scope="col" style="gap: 20px">
                        @if($report->premise->deletedForReason === null && $report->premise->bannedOwner === null && $report->statuses === 'На рассмотрении')
                        <button type="button" class="btn btn-yellow" data-bs-toggle="modal"
                                    style="background-color: #FFC300; border: none; margin-bottom: 10px"
                                    data-bs-target="#deleteModal-{{ $report->id }}">
                                Удалить объявление
                            </button>

                            <div class="modal fade" id="deleteModal-{{ $report->id }}" tabindex="-1"
                                 aria-labelledby="deleteModalLabel-{{ $report->id }}"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="background-color: black;">
                                        <div class="modal-header" style="border-bottom-color: #FFC300">
                                            <h1 class="modal-title fs-5" style="font-family: Montserrat; color: white"
                                                id="deleteModalLabel-{{ $report->id }}">
                                                Удаление недвижимости
                                            </h1>
                                            <button style="background-color: white" type="button" class="btn-close"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form
                                            action="{{route('deletePremiseFromCatalog', ['premiseId' => $report->premise_id])}}"
                                            method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="mb-3" id="reason">
                                                    <label for="reason" class="form-label" style="color: white">Причина
                                                        удаления</label>
                                                    <textarea class="form-control"
                                                              name="reason" id="reason" rows="5" required></textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer" style="border-top-color: #FFC300">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Закрыть
                                                </button>
                                                <button type="submit" class="btn btn-yellow"
                                                        style="background-color: #FFC300">
                                                    Сохранить
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{route('banUser', ['userId' => $report->premise->user_id])}}">
                                @csrf
                                <button type="submit" class="btn btn-danger" style=" margin-bottom: 10px">Заблокировать пользователя</button>
                            </form>
                            <form method="post" action="{{route('changeStatusDenied', ['reportId' => $report->id])}}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Отклонить</button>
                            </form>
                        @else
                            @if($report->statuses === 'Решено')
                                <button class="btn btn-success">Решена</button>
                            @elseif($report->statuses === 'Отклонена')
                                <button class="btn btn-danger">Отклонено</button>
                            @endif
                        @endif
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
