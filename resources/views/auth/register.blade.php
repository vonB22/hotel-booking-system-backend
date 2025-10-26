@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height:60vh">
    <div class="col-12 col-md-10 col-lg-8">
        <div class="card shadow-sm overflow-hidden">
            <div class="row g-0">
                <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center bg-secondary text-white p-4">
                    <div class="text-center px-3">
                        <i class="fa-solid fa-user-plus fa-3x mb-3"></i>
                        <h3 class="fw-bold">Create your account</h3>
                        <p class="mb-0">Join StayEase to manage listings, bookings and more.</p>
                    </div>
                </div>

                <div class="col-md-7 p-4">
                    <h5 class="mb-3">Register</h5>

                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <a href="{{ route('login') }}" class="text-muted">Already have an account?</a>
                            <button type="submit" class="btn btn-primary px-4">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
