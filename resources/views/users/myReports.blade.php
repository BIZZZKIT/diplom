<style>
    .cards {
        padding-top: 94px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }
</style>
@extends('welcome')
@section('title', 'Мои жалобы')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center" style="padding-top: 10px;"><h1>Жалобы</h1></div>
        <div class="cards">
            @foreach($reports as $report)
                @php
                    $premise = $report->premise;
                    $imagePaths = $premise->images->pluck('path')->toArray();
                @endphp
                @include('components.card', array('imagePaths' => $imagePaths, 'premise' => $premise, 'report' => $report ))
            @endforeach
        </div>
    </div>
@endsection
