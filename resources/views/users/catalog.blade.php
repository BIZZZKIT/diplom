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


</style>
@extends('welcome')
@section('title', 'Каталог')
@section('content')
    <div class="container">
        <form class="d-flex justify-content-center align-items-center" action="">
            <button type="button" class="btn btn-yellow" data-bs-toggle="modal" style="background-color: #FFC300; border: none" data-bs-target="#exampleModal">
                Добавить недвижимость
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: black;">
                        <div class="modal-header" style="border-bottom-color: #FFC300">
                            <h1 class="modal-title fs-5" style="font-family: Montserrat" id="exampleModalLabel">Добавление недвижимости</h1>
                            <button style="background-color: white" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('createPremise')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Цена</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" required>
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="count_room" class="form-label">Кол-во комнат</label>
                                    <input type="number" class="form-control @error('count_room') is-invalid @enderror" id="count_room" name="count_room" required>
                                    @error('count_room')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="square" class="form-label">Площадь</label>
                                    <input type="text" class="form-control @error('square') is-invalid @enderror" id="square" name="square" required>
                                    @error('square')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Адрес</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>
                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Описание</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10"></textarea>
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer" style="border-top-color: #FFC300">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-yellow" style="background-color: #FFC300">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
