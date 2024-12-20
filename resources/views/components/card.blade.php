<div class="card" style="width: 26.125rem;">
    @if(!empty($imagePaths))
        <div id="carousel-{{ $premise->id }}" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($imagePaths as $index => $path)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $path) }}" class="d-block w-100" style="height: 255px" alt="Image {{ $index + 1 }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $premise->id }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $premise->id }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif
    <div class="card-body">
        <p class="card-text">
            {{ $premise->description }}
        </p>
    </div>
</div>
