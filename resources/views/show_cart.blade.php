
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
        margin-top: 20px;
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
                    <div class="card-header">{{ __('Cart') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        @endif
                        @php
                            $total_price = 0;
                        @endphp
                        <div class="card-group m-auto">
                            @foreach ($carts as $cart)
                                <div class="card m-3" style="width: 14rem;">
                                    <img class="card-img-top" src="{{ url('storage/' . $cart->product->image) }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $cart->product->name }}</h5>
                                        <form action="{{ route('update_cart', $cart) }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" aria-describedby="basic-addon2" name="amount" value="{{ $cart->amount }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="submit">Update amount</button>
                                                </div>
                                            </div>
                                        </form>
                                        <form action="{{ route('delete_cart', $cart) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                @php
                                    $total_price += $cart->product->price * $cart->amount;
                                @endphp
                            @endforeach
                        </div>
                        <div class="d-flex flex-column justify-content-end align-items-end">
                            @php
                                $discount_rate = 0; // Inisialisasi variabel untuk tarif diskon
                                $discount = 0; // Inisialisasi variabel untuk jumlah diskon
                                
                                // Cek jika total harga pembelian lebih dari 200.000
                                if ($total_price > 200000 && $total_price < 500000) {
                                    $discount_rate = 0.1; // Set diskon sebesar 10%
                                } elseif ($total_price >= 500000) { // Cek jika total harga pembelian lebih dari atau sama dengan 500.000
                                    $discount_rate = 0.2; // Set diskon sebesar 20%
                                }
                        
                                // Hitung jumlah diskon
                                $discount = $discount_rate * $total_price;
                                
                                // Hitung total bayar setelah diskon
                                $total_bayar = $total_price - $discount;
                            @endphp
                            
                            <p>Total Harga: Rp{{ $total_price }}</p>
                            @if ($discount_rate > 0)
                                <p>Besaran Diskon: {{ $discount_rate * 100 }}%</p> <!-- Tampilkan besaran diskon sebagai persen -->
                            @else
                                <p>Besaran Diskon: Tidak ada diskon</p>
                            @endif
                            <p>Diskon: Rp{{ $discount }}</p>
                            <p>Total Bayar: Rp{{ $total_bayar }}</p>
                            
                            <!-- Form untuk checkout -->
                            <form action="{{ route('checkout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary" @if ($carts->isEmpty()) disabled @endif>Checkout</button>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

