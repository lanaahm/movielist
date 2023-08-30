@extends('layout.main') @section('container')
<div class="container-sm">
    <div class="row">
        <div class="col-6">
            <div class="form-box">
                <h3 class="mb-4">Hallo, Welcome back to <span class="main-color">Movie</span><span>List</span>
                </h3>
                <form method="post" action="/register">
                    @csrf
                    <!-- Email input -->
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Username</span>
                        <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Email input -->
                    <div class=" input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                        <input name="email" type="text" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Password</span>
                        <input name="password" type="password" class="form-control  @error('password') is-invalid @enderror" value="{{ old('password') }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Confrim Password</span>
                        <input name="accpassword" type="password" class="form-control  @error('accpassword') is-invalid @enderror" value="{{ old('accpassword') }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                        @error('accpassword')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col d-flex">
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-logreg btn-primary btn-block btn btn-primary btn-block w-100 justify-content-center">
                                Register
                            </button>
                        </div>
                    </div>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Don't have an account? <a href="/login" class="txtred">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
