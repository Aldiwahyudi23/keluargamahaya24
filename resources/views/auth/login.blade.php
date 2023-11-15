@extends('layouts.app')
@section('content')
<!-- pengambil data untuk profile app -->
<?php

use App\Models\ProfileApp;

$profile_app = ProfileApp::first();
?>

<style type="text/css">
    .card-body {
        background: rgba(4, 29, 23, 0.5);
    }
</style>

<div class="card-body login-card-body">
    {!!$profile_app->title_login!!}

    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail') }}" name="email" value="{{ old('email') }}" autocomplete="off" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input id="password" type="password" placeholder="{{ __('Kata Sandi') }}" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="row mb-1">
            <div class="col-7">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember" class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" style="color: white;">
                        {{ __('Tetep Masuk') }}
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class=" col-5">
                <button type="submit" id="btn-login" class="btn btn-primary btn-block">{{ __('Masuk') }} &nbsp; <i class="nav-icon fas fa-sign-in-alt"></i></button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <p class="mb-1" style="color: white">
        @if($profile_app->lupa_password == 1)
        @if (Route::has('password.request'))
        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
            {{ __('Lupa Kata Sandi?') }}
        </a>
        @endif
        @else
        Pami Kata sandi na hilap, kontak ka sekertaris.
        @endif

    </p>
    <div>
        <a href="">Bantuan tutor</a>
    </div>

</div>
@endsection