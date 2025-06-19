<style>
    .cards {
        padding-top: 94px;
        padding-bottom: 94px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }
</style>
@extends('welcome')
@section('title', 'Сохраненные помещения')
@section('content')
<div class="container">
    @if(session('successDestroySaved'))
        <div
            class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
            style="z-index: 1050; background-color: #f6ebc0; color: rgba(251,171,18,0.73)" role="alert">
            {{ session('successDestroySaved') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    @endif
    <div class="d-flex justify-content-center" style="padding-top: 10px;"><h1>Сохраненные объекты</h1></div>
    <div class="cards">
        @foreach($savedPremises as $savedPremise)
            @php
                $premise = $savedPremise->premise;
                $imagePaths = $premise->images->pluck('path')->toArray();
            @endphp
            <a href="{{route('premiseItem', ['premiseId' => $premise->id])}}">@include('components.card', array('imagePaths' => $imagePaths, 'premise' => $premise))</a>
        @endforeach
    </div>
</div>
@endsection
