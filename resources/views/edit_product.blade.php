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
                    <div class="card-header">{{ __('Update Product') }}</div>
                    <div class="card-body">
                        <form action="{{ route('update_product', $product) }}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" placeholder="Description" class="form-control" value="{{ $product->description }}">
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" placeholder="Price" class="form-control" value="{{ $product->price }}">
                            </div>
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" name="stock" placeholder="Stock" class="form-control" value="{{ $product->stock }}">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-dark mt-3">Submit data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
