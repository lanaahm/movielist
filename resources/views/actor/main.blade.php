@extends('layout.main')
@section('container')

<div class="section">
    <div class="container">
        <div class="section-header">
            <h3>Actor</h3>

            <div class="d-flex">
                <form id="search" class="d-flex" role="search" action="/actor">
                    @csrf
                    <input id="searchkey" name="search" value="{{ request('search') }}" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form>
                @auth
                @if (auth()->user()->is_admin)
                <a class="btn btn-danger btn-movielist" href="/actor_add" role="button">Add Actor</a>
                @endif
                @endauth
            </div>

        </div>
        @if (session()->has('deleteActor_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('deleteActor_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row justify-content-start">
            @foreach ( $actor as $d )
            <div class="normal col-3 col-lg-3 col-md-4 col-sm-6 my-3">
                <div class="module pageactor">
                    <div class="thumbnail">
                        <img src="{{ $d->photo ? asset('images/actor/'.$d->photo) : 'https://via.placeholder.com/268x200?text=Profile+actor' }}" />
                    </div>
                    <div class="content-act">
                        <a href="/actor/{{ $d->slug }}">
                            <h1 class="title">{{ $d->name }}</h1>
                        </a>
                        <h2 class="sub-title text-truncate">{{ $d->biography }}</h2>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    document.getElementById("body").onkeypress = function(e) {
        if (e.keyCode === 13) {
            document.getElementById("search").submit();
        }
        return true;
    };

</script>
@endsection
