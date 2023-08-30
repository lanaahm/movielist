@extends('layout.main') @section('container')
<div class="container-sm">
    <div class="row">
        <div class="col-9">

            <div class="section-header mt-5">Edit Actor</div>

            <form class="form-admin" method="post" action="/actor_update/{{ $actor->slug }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input name="slug" type="hidden" value="{{ $actor->slug }}" id="id" class="form-control @error('name') is-invalid @enderror">
                <div class="input-admin mb-3">
                    <label for="FormControlInput1" class="form-label">Name</label>
                    <input name="name" type="text" value="{{ old('name', $actor->name) }}" id="FormControlInput1" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput2" class="form-label">Gender</label>
                    <select name="gender" id="FormControlInput2" class="form-select @error('gender') is-invalid @enderror" aria-label="Default select example">
                        <option value="Male" {{ $actor->gender == 1 ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $actor->gender == 1 ? '' : 'selected' }}>Female</option>
                    </select> @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput3" class="form-label">Biography</label>
                    <textarea name="biography" id="FormControlInput3" class="form-control @error('biography') is-invalid @enderror" rows="3">{{ old('biography', $actor->biography) }}</textarea>
                    @error('biography')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput4" class="form-label">Date of Birth</label>
                    <input name="date_of_birth" id="FormControlInput4" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $actor->date_of_birth) }}">
                    @error('date_of_birth')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput5" class="form-label">Place of Birth</label>
                    <input name="place_of_birth" id="FormControlInput5" type="text" class="form-control @error('place_of_birth') is-invalid @enderror" value="{{ old('place_of_birth', $actor->place_of_birth) }}">
                    @error('place_of_birth')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="input-admin mb-3">
                    <label for="formFile" class="form-label">Image URL</label>
                    <input type="hidden" name="oldImage" value="{{ $actor->photo }}" />
                    <input name="photo" class="form-control @error('photo') is-invalid @enderror" type="file" id="formFile">
                    @error('photo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput6" class="form-label">Popularity</label>
                    <input name="popularity" id="FormControlInput6" type="numeric" class="form-control @error('popularity') is-invalid @enderror" value="{{ old('popularity', $actor->popularity) }}">
                    @error('popularity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row mb-4 justify-content-start">
                    <button type="submit" class="btn btn-primary btn-logreg w-auto px-3 mx-3">
                        Update actor
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
