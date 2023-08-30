@extends('layout.main') @section('container')
<div class="container">
    <div class="main-body">
        <div class="row">

            <div class="col-lg-5">
                <div class="card bg-transparent border-0">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <h4 class="mb-3"> <i class="main-color"></i>My<span class="main-color">Profile</span></h4>
                            <img src="{{ $user->image ? asset('images/user/'.$user->image) : asset('images/avatar.png') }}" alt="Admin" class="rounded-circle p-1 bg-white" width="110" data-bs-toggle="modal" data-bs-target="#exampleModal" style="height: 110px; width: 110px;">
                            <div class="mt-3">
                                <h4>{{ $user->username }}</h4>
                                <p class="text-secondary mb-1">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                @if (session()->has('editProfile_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('editProfile_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card bg-transparent border-0">
                    <div class="card-body">

                        <form method="post" action="/profile/{{ $user->id }}">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Username</span>
                                    <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Date of Birth</span>
                                    <input name="date_of_birth" id="FormControlInput4" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $user->dob) }}">
                                    @error('date_of_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Phone</span>
                                    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col d-flex">
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-logreg btn-block btn btn-primary btn-block w-100 justify-content-center" style="font-weight: 300;">
                                        Save Change
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/profile/avatar/{{ $user->id }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Image</h1>
                    <button type="button" class="btn-cls" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container py-1 px-0">
                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="custom-file d-flex flex-row-reverse">
                                    <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" required>
                                    <label class="custom-file-label text-left" for="customFile">Image URL</label>
                                </div>
                            </div>
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div id="passwordHelpBlock" class="form-text">
                                Please upload your image to other source frist and Use the URL
                            </div>
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
    $(".custom-file input").change(function(e) {
        $(this).next(".custom-file-label").html($(this)[0].files[0].name);
    });

</script>
@endsection
