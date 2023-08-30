@extends('layout.main')
@section('container')
<div class="container mt-5">
    @if (session()->has('deleteMovie_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('deleteMovie_success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="section-header">
        <h3 class="mb-0"><i class="bi bi-film"></i> Show</h3>
        <div class="d-flex">
            <form id="search" class="d-flex" role="search" action="/movie">
                @csrf
                <input id="searchkey" name="search" value="{{ request('search') }}" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </form>
            @auth
            @if (auth()->user()->is_admin)
            <a class="btn btn-danger btn-movielist" href="/movie_add" role="button">Add Movie</a>
            @endif
            @endauth
        </div>
    </div>
    <div class="row d-flex justify-content-start" style="margin: 10px -10px;">
        @foreach ( $genres as $genre )
        <a href="/movie/genre/{{$genre->slug}}" role="button" class="btn btn-outline-secondary w-auto btn-genre">{{$genre->genre}}</a>
        @endforeach
    </div>
    <div class="row sorted">
        <h1>Sort by:</h1>
        <a href="/movie/sorted/latest" role="button" class="btn btn-outline-secondary w-auto btn-genre">Latest</a>
        <a href="/movie/sorted/A-Z" role="button" class="btn btn-outline-secondary w-auto btn-genre">A-Z</a>
        <a href="/movie/sorted/Z-A" role="button" class="btn btn-outline-secondary w-auto btn-genre">Z-A</a>
    </div>
    <div class="row justify-content-start">
        @foreach ($movies as $movie )
        <div class="normal col-3 col-lg-3 col-md-4 col-sm-6 my-3">
            <!-- MOVIE ITEM -->
            <a href="/movie/{{$movie->slug}}" class="movie-item">
                <img src="{{ $movie->thumbnail ? asset('images/movie/'.$movie->thumbnail) : 'https://via.placeholder.com/300x440?text=Thumbnail+Movie' }}" alt="" />
                <div class="movie-item-content">
                    <div class="movie-item-title">{{ $movie->title }}</div>
                    <div class="movie-infos">
                        <div class="movie-info">
                            <span>{{ $movie->genres->genre }}</span>
                        </div>
                        <div class="movie-info">
                            <i class="bi bi-camera-reels-fill"></i>
                            <span>{{ $movie->director }}</span>
                        </div>
                        <div class="movie-info">
                            <i class="bi bi-calendar-week-fill"></i>
                            <span>{{ DateTime::createFromFormat("Y-m-d", $movie->release_date)->format("Y") }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END MOVIE ITEM -->
        @endforeach
    </div>

</div>
@endsection
