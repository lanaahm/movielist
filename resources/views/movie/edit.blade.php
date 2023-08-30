@extends('layout.main')
@section('container')
<div class="container-sm">
    <div class="row">
        <div class="col-9">

            <div class="section-header mt-5">Edit Movie</div>

            @if (session()->has('addMovie_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('addMovie_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form class="form-admin" method="post" action="/movie_update/{{ $movie->slug }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="input-admin mb-3">
                    <label for="FormControlInput1" class="form-label">Title</label>
                    <input name="slug" type="hidden" value="{{ $movie->slug }}">
                    <input name="title" type="text" id="FormControlInput1" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $movie->title) }}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput2" class="form-label">Description</label>
                    <textarea name="description" id="FormControlInput2" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $movie->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput3" class="form-label">Genre</label>
                    <select name="genre_id" class="form-select" aria-label="Default select example">
                        <option value selected>-- Open this select menu --</option>
                        @foreach ($genres as $genre)
                        @if (old('genre_id', $movie->genre_id) == $genre->id)
                        <option value="{{$genre->id}}" selected>{{$genre->genre}}</option>
                        @else
                        <option value="{{$genre->id}}">{{$genre->genre}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('genre_id')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput4" class="form-label">Director</label>
                    <input name="director" type="text" id="FormControlInput4" class="form-control @error('director') is-invalid @enderror" value="{{ old('director', $movie->director) }}">
                    @error('director')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput4" class="form-label">Actors</label>
                    <div id="dynamicActor">
                        @foreach ($movie->movie_actors as $key => $dd )
                        <div class="sub-input m-3">
                            <div class="sub-input-admin m-3">
                                <label for="FormControlInput4" class="form-label">Actor</label>
                                <input type="hidden" name="actor[{{$key}}][oldActor]" value="{{ $dd->actors[0]->id }}" />
                                <select name="actor[{{$key}}][actor]" class="form-select @error('actor.'.$key.'.actor') is-invalid @enderror" aria-label="Default select example">
                                    <option value="" selected>-- Open this select menu --</option>
                                    @foreach ($actors as $actor)
                                    @if (old('actor.'.$key.'.actor', $dd->actors[0]->id) == $actor->id)
                                    <option value="{{$actor->id}}" selected>{{$actor->name}}</option>
                                    @else
                                    <option value="{{$actor->id}}">{{$actor->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('actor.{{$key}}.actor')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="sub-input-admin m-3">
                                <label for="FormControlInput4" class="form-label">Character Name</label>
                                <input type="hidden" name="actor[{{$key}}][oldCharacter]" value="{{ $dd->character_name }}" />
                                <input name="actor[{{$key}}][character]" type="text" id="FormControlInput1" class="form-control @error('actor.'.$key.'.character') is-invalid @enderror" value="{{ old('actor.'.$key.'.character', $dd->character_name) }}">
                                @error('actor.'.$key.'.character')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="add-more">
                        <button type="button" id="addactor" class="btn btn-primary w-auto px-3 mx-3">
                            Add more
                        </button>
                    </div>
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput5" class="form-label">Relese Date</label>
                    <input name="release_date" id="FormControlInput5" type="date" class="form-control @error('release_date') is-invalid @enderror" value="{{ old('release_date', $movie->release_date) }}">
                    @error('release_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="formFile" class="form-label">Image URL</label>
                    <input type="hidden" name="oldThumbnail" value="{{ $movie->thumbnail }}" />
                    <input name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" type="file" id="formFile">
                    @error('thumbnail')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="formFile" class="form-label">Background URL</label>
                    <input type="hidden" name="oldBackground" value="{{ $movie->background }}" />
                    <input name="background" class="form-control @error('background') is-invalid @enderror" type="file" id="formFile">
                    @error('background')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row mb-4 justify-content-start">
                    <button type="submit" class="btn btn-primary btn-logreg w-auto px-3 mx-3">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var i = $('.sub-input.m-3').length;
    $('#addactor').click(function() {
        ++i;
        $('#dynamicActor').append(
            `
            <div class="sub-input m-3">
                <div class="sub-input-admin m-3">
                    <label for="FormControlInput4" class="form-label">Actor</label>
                    <select name="actor[${i}][actor]" class="form-select @error('actor.${i}.actor') is-invalid @enderror" aria-label="Default select example">
                        <option value="" selected>-- Open this select menu --</option>
                        @foreach ($actors as $actor)
                        <option value="{{$actor->id}}">{{$actor->name}}</option>
                        @endforeach
                    </select>
                    @error('actor.${i}.actor')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="sub-input-admin m-3">
                    <label for="FormControlInput4" class="form-label">Character Name</label>
                    <input name="actor[${i}][character]" type="text" id="FormControlInput1" class="form-control @error('actor.${i}.character') is-invalid @enderror" value="{{ old('actor.${i}.character') }}">
                    @error('actor.${i}.character')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            `
        );
    });

</script>
@endsection
