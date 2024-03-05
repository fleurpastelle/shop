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

    .fuwa {
        display: flex;
        margin-top: 200px;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        padding: 20px;
    }
    </style>
</head>

@include('layouts.navbar') <!-- Panggil navbar.blade.php -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card fuwa">
                <div class="card-header">{{ __('Orders') }}</div>
                <div class="card-body m-auto">
                    @foreach ($orders as $order)
                    <div class="card mb-2" style="width: 30rem;">
                        <div class="card-body">
                            <a href="{{ route('show_order', $order) }}">
                                <h5 class="card-title text-dark">Order ID {{ $order->id}}</h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted">By {{ $order->user?->name ?? 'Unknown' }}</h6>
                            @if ($order->is_paid == true)
                                <p class="card-text">Paid</p>
                                @if (Auth::user())
                                    <a href="{{route('nota', $order)}}" class="btn btn-dark">Print</a>
                                @endif
                            @else
                                <p class="card-text">Unpaid</p>
                                @if ($order->payment_receipt)
                                    <div class="d-flex flew-row justify-content-between">
                                        <a href="{{url('storage/'.$order->payment_receipt)}}" class="btn btn-dark">Show payment receipt</a>
                                        @if(Auth::user()->is_admin)
                                            <form action="{{route('confirm_payment',$order)}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-dark">Confirm</button>
                                            </form>
                                        @endif
                                        <!-- Tambahkan tombol Reject Payment di sini -->
                                        <form action="{{ route('reject_payment', $order) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Reject Payment</button>
                                        </form>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
