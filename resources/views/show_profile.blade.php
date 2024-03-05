<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kyou Coffee') }}</title>

    <!-- Logo -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/coffee-logo.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.min.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        * {
            font-family: 'Manrope', sans-serif;
        }

        .login {
            display: flex;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

    </style>
</head>

@include('layouts.navbar') <!-- Panggil navbar.blade.php -->

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 p-5">
                <div class="card login">
                    <div class="card-header">{{ __('Profile') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                        @endif
                        <form action="{{ route('edit_profile') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" name="name" class="form-control" value="{{ $user->name }}" required autofocus placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control" value="{{ $user->email }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="role">{{ __('Role') }}</label>
                                <input id="role" type="text" class="form-control" value="{{ $user->is_admin ? 'Admin' : 'Member' }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" name="password_confirmation" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-dark">{{ __('Change profile details') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

