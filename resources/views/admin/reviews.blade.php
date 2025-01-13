@extends('welcome')
@section('title', 'Отзывы')
@section('content')
    <div class="reviews">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <h1>Отзывы</h1>
            </div>
            <table class="table table-bordered " style="border-radius: 20px; overflow: hidden; margin: 50px;">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Владелец отзыва</th>
                    <th scope="col">Текст отзыва</th>
                    <th scope="col">Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <th scope="col">{{$review->id}}</th>
                        <th scope="col">{{$review->user->FIO}}</th>
                        <th scope="col">{{$review->textReview}}</th>
                        <th scope="col">
                            <form method="post" action="{{route('deleteReview', ['reviewId' => $review->id])}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
