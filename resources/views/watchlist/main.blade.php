@extends('layout.main') @section('container')

<div class="container">
    <div class="main-body mt-4">
        <div class="section-header">
            <h3 class="mb-0 watchList-title"><i class="bi bi-bookmark-fill mark"></i> My WatchList</h3>
        </div>
        @if (session()->has('watchlistAction_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('watchlistAction_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">

            <form id="search" class="d-flex" role="search" action="/watchlist">
                @csrf
                <div class="form-group input-group pull-right">
                    <input type="text" name="search" class="search form-control" placeholder="Search your Watchlist">
                    <div class="input-group-text"><i class="bi bi-search"></i></div>
                </div>
            </form>

            <div class="row sorted justify-content-start">
                <h1>Filter by:</h1>
                <a href="/watchlist/sorted/all" role="button" class="btn btn-outline-secondary w-auto btn-genre">Latest</a>
                <a href="/watchlist/sorted/planned" role="button" class="btn btn-outline-secondary w-auto btn-genre">Planned</a>
                <a href="/watchlist/sorted/watching" role="button" class="btn btn-outline-secondary w-auto btn-genre">Watching</a>
                <a href="/watchlist/sorted/finish" role="button" class="btn btn-outline-secondary w-auto btn-genre">Finish</a>
            </div>
            <table class="table table-hover table-bordered results">
                <thead>
                    <tr>
                        <th>Poster</th>
                        <th class="col-md-4 col-xs-4">Title</th>
                        <th class="col-md-3 col-xs-3">Status</th>
                        <th class="col-md-3 col-xs-3">Action</th>
                    </tr>
                    <tr class="warning no-result">
                        <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($watchlist as $dd )
                    <tr>
                        <th scope="row"><img src="{{ $dd->movies->thumbnail ? asset('images/movie/'.$dd->movies->thumbnail) : 'https://via.placeholder.com/268x200?text=Movie+Image' }}" alt="Free guy movie poster" /></th>
                        <td>{{ $dd->movies->title }}</td>
                        <td style="color:green">{{ $status[$dd->status] }}</td>
                        <td><button type="button" class="btn btn-outline-secondary border-0" data-bs-toggle="modal" data-bs-target="#watchlistModal" data-bs-id="{{$dd->id}}" data-bs-status="{{$dd->status}}"><i class="bi bi-three-dots m-0"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                <span class="counter pull-right">
                    Showing {{ $watchlist->firstItem() }} to {{ $watchlist->lastItem() }}
                    of total {{$watchlist->total()}} results</span>
                {!! $watchlist->links() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="watchlistModal" tabindex="-1" aria-labelledby="watchlistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/" id="changeStausAction">
                @method('put')
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="watchlistModalLabel">Change Status</h1>
                    <button type="button" class="btn-cls" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container py-1 px-0">

                        <div class="input-admin mb-3">
                            <select name="status" id="changeStatus" class="form-select @error('gender') is-invalid @enderror" aria-label="Default select example">
                                <option value="0">Planned</option>
                                <option value="1">Watching</option>
                                <option value="2">Finish</option>
                                <option value="3">Remove</option>
                            </select> @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-logreg">Send message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const watchlistModal = document.getElementById('watchlistModal')
        watchlistModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            const id = button.getAttribute('data-bs-id')
            const status = button.getAttribute('data-bs-status')
            const modalTitle = watchlistModal.querySelector('.modal-title')
            const modalBodyInput = watchlistModal.querySelector('.modal-body input')
            const frm = document.querySelector('#changeStausAction');
            const select = document.querySelector('#changeStatus');
            select.value = status
            frm.action = `/watchlist/${id}`;
        })
    });

</script>
@endsection
