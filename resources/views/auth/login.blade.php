@extends('layout.main') @section('container')
<div class="container-sm">
    <div class="row">
        <div class="col-6">
            <div class="form-box">
                <h3 class="mb-4">Hallo, Welcome back to <span class="main-color">Movie</span><span>List</span>
                </h3>

                @if (session()->has('register_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('register_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif (session()->has('login_error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('login_error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form method="post" action="/login">
                    @csrf
                    <!-- Email input -->
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                        <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Password</span>
                        <input name="password" type="password" class="form-control @error('email') is-invalid @enderror" value="{{ old('password') }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col d-flex">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                                <label class="form-check-label" for="form2Example31">
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col d-flex">
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-logreg btn-block btn btn-primary btn-block w-100 justify-content-center">
                                Sign in
                            </button>
                        </div>
                    </div>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Don't have an account? <a href="/register" class="txtred">Register now!</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
