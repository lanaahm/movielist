@extends('layout.main')
@section('container')

<div class="section">
    <div class="container">
        <div class="row prsonal-information">
            @if (session()->has('editActor_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('editActor_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="col-3 col-sm-12">
                <div class="normal">
                    <div class="module">
                        <div class="thumbnail">
                            <img src="{{ $actor->photo ? asset('images/actor/'.$actor->photo) : 'https://via.placeholder.com/268x200?text=Profile+actor' }}" />
                            @auth
                            @if (auth()->user()->is_admin)
                            <div class='update'>
                                <a href="/actor_update/{{ $actor->slug }}"><i class="bi bi-pencil-square"></i></a>
                            </div>
                            <div class='delete'>
                                <form action="/actor/{{ $actor->slug }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h1 class="information title">Personal Info</h1>
                    <div class="col-12 mt-2">
                        <h1 class="title">Popularity</h1>
                        <h2 class="sub-title">{{ $actor->popularity }}</h2>
                    </div>
                    <div class="col-12 mt-2">
                        <h1 class="title">Gender</h1>
                        <h2 class="sub-title">{{ $actor->gender == 1 ? 'Male' : 'Female' }}</h2>
                    </div>
                    <div class="col-12 mt-2">
                        <h1 class="title">Birthday</h1>
                        <h2 class="sub-title">{{ $actor->date_of_birth }}</h2>
                    </div>
                    <div class="col-12 mt-2">
                        <h1 class="title">Place of Birth</h1>
                        <h2 class="sub-title">{{ $actor->place_of_birth }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-9 col-sm-12">
                <div class="row">
                    <div class="col-12 mt-2">
                        <h1 class="information name">{{ $actor->name }}</h1>
                        <h1 class="information title m-0 mb-2">Biography</h1>
                        <p>{{ $actor->biography }}</p>
                    </div>
                    <div class="col-12 mt-2">
                        <h1 class="information title m-0 mb-2">Know For</h1>
                        <div class="row justify-content-start">
                            @foreach ($actor->movie_actors as $dd )
                            <div class="normal col-3 col-lg-3 col-md-4 col-sm-6 my-3">
                                <div class="module pageactor detail">
                                    <div class="thumbnail">
                                        <img src="{{ $dd->movies[0]->thumbnail ? asset('images/movie/'.$dd->movies[0]->thumbnail) : 'https://via.placeholder.com/268x200?text=Movie' }}" />
                                    </div>
                                    <div class="content-act">
                                        <a href="/movie/{{ $dd->movies[0]->slug }}">
                                            <h1 class="title">{{ $dd->movies[0]->title }}</h1>
                                        </a>
                                        <h2 class="sub-title">{{ $dd->movies[0]->genres->genre }}</h2>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
