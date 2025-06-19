@extends('welcome')
@section('title', 'Отзывы')
@section('content')
    <style>
        /* Общие стили */
        body {
            background-color: #1a1a1a;
            color: #ddd;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 10px;
        }

        .reviews {
            margin: 20px 0;
        }

        .reviews h1 {
            font-size: 1.5rem;
            text-align: center;
            color: #ddd;
            margin-bottom: 20px;
        }

        /* Таблица */
        .reviews-table {
            background-color: #222 !important;
            border: 1px solid #444;
            border-radius: 8px;
            overflow: hidden;
            margin: 20px 0;
            width: 100%;
            table-layout: fixed;
        }

        .reviews-table thead {
            background-color: #333;
        }

        .reviews-table th,
        .reviews-table td {
            border: 1px solid #444;
            padding: 0.5rem;
            text-align: center;
            vertical-align: middle;
            font-size: 0.85rem;
            color: #ddd !important;
        }

        .reviews-table th {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .reviews-table tbody tr {
            transition: background-color 0.3s ease;
        }

        .reviews-table tbody tr:hover {
            background-color: #2a2a2a;
        }

        /* Исключение для колонки Текст отзыва */
        .reviews-table td:not(.review-text),
        .reviews-table th:not(.review-text) {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .reviews-table .review-text {
            overflow: visible;
            white-space: normal;
        }

        /* Кнопки */
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

        /* Адаптивность */
        @media (max-width: 576px) {
            body {
                font-size: 0.8rem;
            }

            .reviews-table th,
            .reviews-table td {
                font-size: 0.8rem;
                padding: 0.4rem;
            }

            .btn-danger {
                width: 100%;
                margin-bottom: 5px;
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            .reviews h1 {
                font-size: 1.3rem;
            }
        }
    </style>

    <div class="reviews">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <h1>Отзывы</h1>
            </div>
            <table class="reviews-table">
                <thead>
                <tr>
                    <th scope="col" style="width: 10%;">ID</th>
                    <th scope="col" style="width: 25%;">Владелец отзыва</th>
                    <th scope="col" class="review-text" style="width: 40%;">Текст отзыва</th>
                    <th scope="col" style="width: 25%;">Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td title="{{ $review->user->FIO }}">{{ $review->user->FIO }}</td>
                        <td class="review-text">{{ $review->textReview }}</td>
                        <td>
                            <form method="POST" action="{{ route('deleteReview', ['reviewId' => $review->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
