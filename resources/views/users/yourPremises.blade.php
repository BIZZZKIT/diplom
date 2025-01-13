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

    .cards {
        padding-top: 94px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }
</style>
@extends('welcome')
@section('title', 'Ваши помещения')
@section('content')
    <div class="container">
        @if(session('successDeleteYourPremise'))
            <div
                class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
                style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
                {{ session('successDeleteYourPremise') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
        @if(session('successEditYourPremise'))
            <div
                class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
                style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
                {{ session('successEditYourPremise') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
        <div class="d-flex justify-content-center" style="padding-top: 10px;"><h1>Ваши объекты</h1></div>
        <div class="cards">
            @foreach($yourPremises as $yourPremise)
                @php
                    $imagePaths = $yourPremise->images->pluck('path')->toArray();
                @endphp

                @include('components.card', ['imagePaths' => $imagePaths, 'premise' => $yourPremise])

            @endforeach
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const editButtons = document.querySelectorAll('.edit-button');
                editButtons.forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.stopPropagation();
                    });
                });
            });
        </script>

    </div>
@endsection
