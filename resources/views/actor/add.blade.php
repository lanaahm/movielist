@extends('layout.main') @section('container')
<div class="container-sm">
    <div class="row">
        <div class="col-9">

            <div class="section-header mt-5">Add Movie</div>

            @if (session()->has('addActor_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('addActor_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form class="form-admin" method="post" action="/actor_add" enctype="multipart/form-data">
                @csrf

                <div class="input-admin mb-3">
                    <label for="FormControlInput1" class="form-label">Name</label>
                    <input name="name" type="text" id="FormControlInput1" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput2" class="form-label">Gender</label>
                    <select name="gender" id="FormControlInput2" class="form-select @error('gender') is-invalid @enderror" aria-label="Default select example">
                        <option selected>-- Open this select menu --</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select> @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput3" class="form-label">Biography</label>
                    <textarea name="biography" id="FormControlInput3" class="form-control @error('biography') is-invalid @enderror" rows="3">{{ old('biography') }}</textarea>
                    @error('biography')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput4" class="form-label">Date of Birth</label>
                    <input name="date_of_birth" id="FormControlInput4" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}">
                    @error('date_of_birth')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput5" class="form-label">Place of Birth</label>
                    <input name="place_of_birth" id="FormControlInput5" type="text" class="form-control @error('place_of_birth') is-invalid @enderror" value="{{ old('place_of_birth') }}">
                    @error('place_of_birth')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="input-admin mb-3">
                    <label for="formFile" class="form-label">Image URL</label>
                    <input name="photo" class="form-control @error('photo') is-invalid @enderror" type="file" id="formFile">
                    @error('photo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-admin mb-3">
                    <label for="FormControlInput6" class="form-label">Popularity</label>
                    <input name="popularity" id="FormControlInput6" type="numeric" class="form-control @error('popularity') is-invalid @enderror" value="{{ old('popularity') }}">
                    @error('popularity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row mb-4 justify-content-start">
                    <button type="submit" class="btn btn-primary btn-logreg w-auto px-3 mx-3">
                        Add actor
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
