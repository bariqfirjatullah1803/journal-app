@extends('layouts.auth')

@section('content')
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
        </div>
        <form class="user" action="{{ route('login.submit') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="email"
                       class="form-control form-control-user @error('email') is-invalid @enderror"
                       id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                       placeholder="Enter Email Address..." value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-user"
                       id="exampleInputPassword" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Login
            </button>
        </form>
    </div>
@endsection
