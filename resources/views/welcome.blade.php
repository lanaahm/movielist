@extends('layout.main')
@section('container')
<!-- HERO SECTION -->
<div class="hero-section">
    <!-- HERO SLIDE -->
    <div class="hero-slide">
        <div class="owl-carousel carousel-nav-center" id="hero-carousel">
            @foreach ($movieb as $banner)
            <!-- SLIDE ITEM -->
            <div class="hero-slide-item">
                <img src="{{asset('images/movie/'.$banner->background)}}" alt="" />
                <div class="overlay"></div>
                <div class="hero-slide-item-content">
                    <div class="item-content-wraper">
                        <div class="item-content-title top-down">{{ $banner->title }}</div>
                        <div class="movie-infos top-down delay-2">
                            <div class="movie-info">
                                <span>{{ $banner->genres->genre }}</span>
                            </div>
                            <div class="movie-info">
                                <span>|</span>
                            </div>
                            <div class="movie-info">
                                <span>{{ DateTime::createFromFormat("Y-m-d", $banner->release_date)->format("Y") }}</span>
                            </div>
                        </div>
                        <div class="item-content-description top-down delay-4">
                            {{ $banner->description }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SLIDE ITEM -->
            @endforeach
        </div>
    </div>
    <!-- END HERO SLIDE -->
</div>
<!-- END HERO SECTION -->

<!-- LATEST MOVIES SECTION -->
<div class="section">
    <div class="container">
        <div class="section-header">
            <h3 class="mb-0"><i class="bi bi-fire"></i> Popular movies</h3>
        </div>
        <div class="movies-slide carousel-nav-center owl-carousel">
            @include('movie.popular_movie')
        </div>
    </div>
</div>
<!-- END LATEST MOVIES SECTION -->

<!-- LATEST SERIES SECTION -->
<div class="section">
    @include('movie.main')
</div>
<!-- END LATEST SERIES SECTION -->
@endsection
