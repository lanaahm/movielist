@foreach ($pmovie as $movie )
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
<!-- END MOVIE ITEM -->
@endforeach
