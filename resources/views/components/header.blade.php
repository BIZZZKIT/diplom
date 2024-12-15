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
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets/images/logo.png')}}" alt="Logo">
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
                        <a class="nav-link" href="#">О компании</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Контакты</a>
                    </li>
                </ul>

                @auth()
                    <div class="account">
                        <li class="nav-item dropdown" style="list-style: none;">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img width="50px" src="{{asset('assets/images/user.png')}}" alt="User">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{route('logout')}}">Выйти</a></li>
                            </ul>
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
