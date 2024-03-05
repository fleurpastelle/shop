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
                <div class="card-header">{{ __('Order Detail') }}</div>
                @php
                    $total_price = 0;
                @endphp
                <div class="card-body">
                    <h5 class="card-title">Order ID {{ $order->id }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">By {{ $order->user->name }}</h6>
                    @if ($order->is_paid == true)
                        <p class="card-text">Paid</p>
                    @else
                        <p class="card-text">Unpaid</p>
                    @endif
                    <hr>
                    @foreach ($order->transactions as $transaction)
                        <p>{{ $transaction->product->name }} - {{ $transaction->amount }} pcs</p>
                        @php
                            $total_price += $transaction->product->price * $transaction->amount;
                        @endphp
                    @endforeach
                    <hr>
                    <p>Total: Rp{{ $total_price }}</p>
                    <hr>
                    @if (Auth::user()->is_admin)
                        <!-- Hanya tampilkan tombol "Reject Payment" jika pengguna adalah admin -->
                        <form action="{{ route('reject_payment', $order) }}" method="post"> <!-- Ubah metode menjadi "post" -->
                            @csrf
                            <button type="submit" class="btn btn-danger">Reject Payment</button>
                        </form>
                    @else
                        <!-- Hanya tampilkan form upload tanda terima pembayaran jika pengguna bukan admin -->
                        <form action="{{ route('submit_payment_receipt', $order) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Upload your payment receipt</label>
                                <input type="file" name="payment_receipt" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit payment</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
