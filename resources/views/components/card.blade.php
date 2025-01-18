@php use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Route; @endphp
<div class="card" style="width: 26.125rem; border-radius: 20px">
    @if(!empty($imagePaths))
        <a href="{{route('premiseItem', ['premiseId' => $premise->id])}}">
            <div id="carousel-{{ $premise->id }}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" style="border-radius: 20px">
                    @foreach($imagePaths as $index => $path)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $path) }}" class="d-block w-100"
                                 style="height: 255px; border-radius: 20px"
                                 alt="Image {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $premise->id }}"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $premise->id }}"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </a>
    @endif
    <div class="card-body">
        <p class="card-text">
            {{ $premise->price }} рублей
        </p>
        <p class="card-text">{{$premise->count_room}}-комн квартира {{$premise->square}} м2</p>
        <p class="card-text">{{$premise->federalDistricts->name}}, {{$premise->regions->name}}
            , {{$premise->cities->name}}, {{$premise->address}}</p>
        @if(Route::is('reports'))
            <div class="btn btn-secondary">{{$report->statuses}}</div>
        @endif
        @if(Auth::check() && !Route::is('reports'))
            @if(!Route::is('savedPremises') && !Route::is('yourPremises') && !Route::is('admin') && !Route::is('yoursReports'))
                <form method="post" action="{{route('savePremise', ['premiseId' => $premise->id])}}">
                    @csrf
                    <button type="submit" class="btn btn-warning" value="{{$premise->id}}">Сохранить</button>
                </form>
            @endif
            @if(Route::is('savedPremises'))
                <form method="post" action="{{route('deleteSavedPremise', ['premiseId' => $premise->id])}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning" value="{{$premise->id}}">Удалить из сохраненных
                    </button>
                </form>
            @elseif(Route::is('yourPremises'))
                @if($premise->deletedForReason === null && $premise->bannedOwner === null)
                    <form method="post" action="{{route('deleteYourPremise', ['premiseId' => $premise->id])}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning" value="{{$premise->id}}">Удалить из каталога
                        </button>
                    </form>
                        <button type="button" class="btn btn-warning edit-button"
                                data-bs-toggle="modal" data-bs-target="#modal-{{ $yourPremise->id }}"
                                style="font-family: 'Montserrat', sans-serif">
                            Изменить данные
                        </button>

                        <div class="modal fade" id="modal-{{ $yourPremise->id }}" tabindex="-1"
                             aria-labelledby="modalLabel-{{ $yourPremise->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="background-color: black;">
                                    <div class="modal-header" style="border-bottom-color: #FFC300">
                                        <h1 class="modal-title fs-5" style="color: white;font-family: Montserrat"
                                            id="exampleModalLabel" >
                                            Изменение данных</h1>
                                        <button style="background-color: white" type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST"
                                          action="{{route('editYourPremise', ['premiseId' => $yourPremise->id])}}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="price" class="form-label" style="color: white">Цена</label>
                                                <input type="number" step="0.01"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       id="price"
                                                       name="price" required>
                                                @error('price')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="count_room" style="color: white" class="form-label">Кол-во комнат</label>
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
                                                <label for="square" style="color: white" class="form-label">Площадь (м²)</label>
                                                <input type="number" step="0.01"
                                                       class="form-control @error('square') is-invalid @enderror"
                                                       id="square"
                                                       name="square" required>
                                                @error('square')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="typeOfSell" style="color: white" class="form-label">Тип продажи</label>
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
                                                <label for="district" style="color: white" class="form-label">Федеральный округ</label>
                                                <select name="district_id" id="district_id" class="form form-select">
                                                    <option>Выберите федеральный округ</option>
                                                    @foreach($federalDistricts as $id => $name)
                                                        <option value="{{$id}}">{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3" id="region_block" style="display: none">
                                                <label for="region_id" style="color: white" class="form-label">Регион</label>
                                                <select name="region_id" id="region_id" class="form form-select">
                                                    @foreach($regions as $id => $name)
                                                        <option value="{{$id}}">{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3" id="city_block" style="display: none">
                                                <label for="city" style="color: white" class="form-label">Город</label>
                                                <select name="city_id" id="city_id" class="form form-select">
                                                    @foreach($cities as $id => $name)
                                                        <option value="{{$id}}">{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label style="color: white" for="flatOrHouse" class="form-label">Тип объекта</label>
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
                                                <label style="color: white" for="address" class="form-label">Адрес</label>
                                                <input type="text"
                                                       class="form-control @error('address') is-invalid @enderror"
                                                       id="address" name="address" required>
                                                @error('address')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label style="color: white" for="photos" class="form-label">Фотографии</label>
                                                <input type="file"
                                                       class="form-control @error('photos') is-invalid @enderror"
                                                       id="photos" name="photos[]" multiple required>
                                                @error('photos')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label style="color: white" for="description" class="form-label">Описание</label>
                                                <textarea
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    name="description" id="description" rows="5" required></textarea>
                                                @error('description')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Закрыть
                                            </button>
                                            <button type="submit" class="btn btn-warning">Сохранить изменения</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                @else
                    <button class="btn btn-danger">Удалено по причине: @if($premise->bannedOwner !== null) Пользователь заблокирован @elseif($premise->deletedForReason !== null) {{$premise->deletedForReason}} @endif</button>
                    @endif
                @endif
                @if(Route::is('yoursReports'))
                    @if($report->statuses === 'Решено')
                        <button class="btn btn-success">{{$report->statuses}}</button>
                    @elseif($report->statuses === 'Отклонена')
                        <button class="btn btn-danger">{{$report->statuses}}</button>
                    @elseif($report->statuses === 'На рассмотрении')
                        <button class="btn btn-secondary">{{$report->statuses}}</button>
                    @endif
                @endif
                @if(Auth::id() !== $premise->user_id && !Route::is('admin') && !Route::is('yoursReports'))
                    <button type="button" class="btn btn-danger report-button" data-bs-toggle="modal"
                            data-bs-target="#reportModal-{{ $premise->id }}">
                        Пожаловаться
                    </button>

                    <div class="modal fade" id="reportModal-{{ $premise->id }}" tabindex="-1"
                         aria-labelledby="reportModalLabel-{{ $premise->id }}"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background-color: black;">
                                <div class="modal-header" style="border-bottom-color: #FFC300">
                                    <h1 class="modal-title fs-5" style="font-family: Montserrat; color: white"
                                        id="reportModalLabel-{{ $premise->id }}">
                                        Жалоба</h1>
                                    <button style="background-color: white" type="button" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{route('createReport', ['premiseId' => $premise->id])}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="reportText-{{ $premise->id }}" class="form-label"
                                                   style="color: white">Описание</label>
                                            <textarea class="form-control" name="reportText"
                                                      id="reportText-{{ $premise->id }}" rows="5"
                                                      required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="photos" class="form-label"
                                                   style="color: white">Доказательства</label>
                                            <input type="file" class="form-control"
                                                   id="photos" name="photos[]" multiple required>
                                        </div>
                                    </div>

                                    <div class="modal-footer" style="border-top-color: #FFC300">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть
                                        </button>
                                        <button type="submit" class="btn btn-yellow" style="background-color: #FFC300">
                                            Отправить
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
    </div>
</div>

