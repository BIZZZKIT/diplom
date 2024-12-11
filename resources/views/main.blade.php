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

</style>
<div class="container">
    <div id="carouselExample" class="carousel slide" style="border-radius: 20px; padding-top: 57px; padding-bottom: 58px;">
        <div class="carousel-inner" style="border-radius: 20px; overflow: hidden; max-height: 670px;">
            <div class="carousel-item active">
                <img src="{{asset('assets/images/carousel/2f6865a8366bde9d6401bf8877276e7e2e6feb8c.png')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/images/carousel/chelyabinsk_manhatten.png')}}" class="d-block w-100" alt="...">
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
<div class="formSearch">
    <div class="container">
        <h1 style="font-family: 'Montserrat'; font-weight: bold; padding-bottom: 86px;">Найди свою мечту</h1>
        <form style="font-family: 'Roboto'; font-weight: normal;">
            <div class="mb-3">
                <select class="form form-select">
                    <option>Продажа</option>
                </select>
            </div>
            <div class="mb-3">
                <select class="form form-select">
                    <option>Регион</option>
                </select>
            </div>
            <div class="mb-3">
                <select class="form form-select">
                    <option>Квартира</option>
                </select>
            </div>
            <div class="mb-3">
                <select class="form form-select">
                    <option>Кол-во комнат</option>
                </select>
            </div>
            <div class="mb-3">
                <select class="form form-select">
                    <option>Город</option>
                </select>
            </div>
            <div class="mb-3">
                <select class="form form-select">
                    <option>Район</option>
                </select>
            </div>
            <div class="mb-3">
                <input class="form-control" placeholder="От">
            </div>
            <div class="mb-3">
                <input class="form-control" placeholder="До">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


