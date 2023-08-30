@extends('layout.main')
@section('container')
{{-- {{dd(!auth()->user()->is_admin && $movie->watchlist->contains('user_id', auth()->user()->id))}} --}}
<section class="movie-detail" style="background: url({{ $movie->background ? asset('images/movie/'.$movie->background) : asset('images/movie/'.$movie->thumbnail) }}) no-repeat">
    <div class="container">
        <figure class="movie-detail-banner" style="background: none">
            <img src="{{ $movie->thumbnail ? asset('images/movie/'.$movie->thumbnail) : 'https://via.placeholder.com/268x200?text=Movie+Image' }}" alt="Free guy movie poster" />
        </figure>


        <div class="movie-detail-content">
            <div class="row">
                @if (session()->has('editMovie_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('editMovie_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
            <div class="meta-header">
                <div class="meta-title">
                    @auth
                    @if(!auth()->user()->is_admin)
                    @if ($movie->watchlist->contains('user_id', auth()->user()->id))
                    <button type="button" style="cursor: default;">
                        <i class="bi bi-bookmark-check-fill mark"></i>
                    </button>
                    @else
                    <form action="/watchlist" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                        <input type="hidden" name="movie_id" value="{{ $movie->id }}" />
                        <input type="hidden" name="status" value="1" />
                        <button type="submit">
                            <i class="bi bi-bookmark-plus-fill"></i>
                        </button>
                    </form>
                    @endif
                    @endif
                    @endauth
                    <h1 class="h1 detail-title m-0">{{ $movie->title }}</h1>
                </div>
                @auth
                @if (auth()->user()->is_admin)
                <div class="action-header">
                    <a href="/movie_update/{{ $movie->slug }}"><i class="bi bi-pencil-square"></i></a>
                    <form action="/movie/{{ $movie->slug }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
                @endif
                @endauth
            </div>
            <div class="meta-wrapper">
                <div class="ganre-wrapper">
                    <a href="/movie/genre/{{$movie->genres->genre}}">{{ $movie->genres->genre }}</a>
                </div>
                <div class="date-time">
                    <div>
                        <ion-icon name="calendar-outline"></ion-icon>
                        <time>{{ DateTime::createFromFormat("Y-m-d", $movie->release_date)->format("Y") }}</time>
                    </div>
                </div>
                <div class="ganre-wrapper mt-4">
                    <h5>Storyline</h5>
                </div>
                <p class="storyline mb-3">
                    {{ $movie->description }}
                </p>
                <div class="ganre-wrapper mt-1">
                    <h5>{{ $movie->director }}</h5>
                </div>
                <p class="storyline">
                    Director
                </p>
            </div>
        </div>
    </div>
</section>
<!-- END HERO SECTION -->

<div class="section">
    <div class="container">
        <div class="section-header">Actor</div>
        <div class="row justify-content-start">
            @foreach ($movie->movie_actors as $dd )
            <div class="normal col-2 col-lg-2 col-md-4 col-sm-6 my-3">
                <a href="/actor/{{ $dd->actors[0]->slug }}">
                    <div class="module" style="height: 280px;">
                        <div class="thumbnail">
                            <img src="{{ $dd->actors[0]->photo ? asset('images/actor/'.$dd->actors[0]->photo) : 'https://via.placeholder.com/268x200?text=Profile+actor' }}" />
                        </div>
                        <div class="content-act">
                            <h1 class="title">{{ $dd->actors[0]->name }}</h1>
                            <h2 class="sub-title">{{ $dd->character_name }}</h2>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- LATEST MOVIES SECTION -->
    <div class="section">
        <div class="container">
            <div class="section-header">More movies</div>
            <div class="movies-slide carousel-nav-center owl-carousel">
                @include('movie.popular_movie')
            </div>
        </div>
    </div>
    <!-- END LATEST MOVIES SECTION -->

    @endsection
