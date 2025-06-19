<style>

    body {
        margin: 0;
        padding: 0;
        background-color: #000;
        color: white;
    }

    a, li {
        font-family: 'Montserrat', sans-serif;
        color: white !important;
        font-size: 20px;
        font-weight: inherit;
    }

    .dropdown-menu {
        background-color: black;
        border: none;
    }

    .dropdown-item {
        font-size: 16px;
        font-weight: normal;
        color: white !important;
    }

    .dropdown-item:hover {
        background-color: #5B5400;
    }

    .navbar-brand img {
        width: 150px;
    }

    .navbar {
        height: 80px;
    }

    .container-fluid {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .navbar-nav {
        flex-grow: 1;
        justify-content: center;
        padding-right: 80px;
    }

    .account {
        display: flex;
        align-items: center;
    }
</style>

<div class="container">
    <nav class="navbar navbar-expand-lg" style="background: none; padding-top: 18px;">
        <div class="container-fluid">

            <!-- Логотип слева -->
            <a class="navbar-brand" href="{{route('welcome')}}">
                <img src="{{asset('/public/assets/images/logo.png')}}" alt="Logo">
            </a>

            <!-- Кнопка-тогглер -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Центральные вкладки -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('catalog')}}">Каталог</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">О компании</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contact')}}" aria-disabled="true">Контакты</a>
                    </li>
                </ul>

                @auth()
                    @if(\Illuminate\Support\Facades\Auth::user()->is_blocked)
                        <button style="margin-right: 10px;" class="btn btn-danger">Вы заблокированы</button>
                    @endif
                    <div class="account">
                        <li class="nav-item dropdown" style="list-style: none;">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img width="50px" src="{{asset('public/assets/images/user.png')}}" alt="User">
                            </a>
                            <ul class="dropdown-menu">
                                @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                                    <li><a class="dropdown-item" href="{{route('admin')}}">Панель администратора</a></li>
                                @else
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userEditModal">
                                            Изменить данные
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{route('savedPremises')}}">Сохраненные объекты</a></li>
                                    <li><a class="dropdown-item" href="{{route('yourPremises')}}">Ваши объекты</a></li>
                                    <li><a class="dropdown-item" href="{{route('yoursReports')}}">Ваши жалобы</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{route('logout')}}">Выйти</a></li>
                            </ul>

                            <!-- Модальное окно (остается без изменений) -->
                            <div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="background-color: black; color: white;">
                                        <div class="modal-header" style="border-bottom-color: #FFC300;">
                                            <h1 class="modal-title fs-5" style="font-family: 'Montserrat', sans-serif;" id="userEditModalLabel">Редактирование профиля</h1>
                                            <button type="button" class="btn-close" style="background-color: white;" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('profile.update') }}">
                                        @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="editFIO" class="form-label">ФИО</label>
                                                    <input type="text" class="form-control @error('FIO') is-invalid @enderror"
                                                           id="editFIO" name="FIO" value="{{ auth()->user()->FIO }}"
                                                           style="background-color: #333; color: white; border-color: #555;">
                                                    @error('FIO')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="editPhone" class="form-label">Телефон</label>
                                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                                           id="editPhone" name="phone" value="{{ auth()->user()->phone }}"
                                                           style="background-color: #333; color: white; border-color: #555;">
                                                    @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="editEmail" class="form-label">Email</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                           id="editEmail" name="email" value="{{ auth()->user()->email }}"
                                                           style="background-color: #333; color: white; border-color: #555;">
                                                    @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="editTelegram" class="form-label">Telegram</label>
                                                    <input type="text" class="form-control @error('telegram_user') is-invalid @enderror"
                                                           id="editTelegram" name="telegram_user" value="{{ auth()->user()->telegram_user }}"
                                                           style="background-color: #333; color: white; border-color: #555;">
                                                    @error('telegram_user')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="border-top-color: #FFC300;">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                <button type="submit" class="btn btn-yellow" style="background-color: #FFC300; border: none;">Сохранить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </div>
                @endauth
                @guest()
                    <div class="d-flex gap-2" style="font-family: Montserrat">
                        <form action="{{route('login')}}">
                            <button type="submit" class="btn btn-enter" style="background-color: white">Войти</button>
                        </form>
                        <form action="{{route('registration')}}">
                            <button type="submit" class="btn btn-yellow" style="background-color: #FFC300">Регистрация</button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
</div>
