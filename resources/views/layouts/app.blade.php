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
        .hero {
            width: 100%;
            height: 100vh;
            background-image: url({{ asset('storage/banner.png') }});
            background-size: cover;
            background-position: center;

            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.navbar')
        <!-- Home -->
        <section id="menu" class="hero">
            <div class="text-center">
                <h1 class="text-light"><strong>Immersed in an anime marathon?</strong></h1>
                <p class="text-light">Dive into Kyou Cafe's Japanese concoction for a refreshing break!</p>
                <div class="text-center">
                    <a class="btn btn-dark" href="#product">Check Our Menu</a>
                </div>
            </div>
        </section>

        <!--Keunggulan-->
        <div id="keunggulan" class="keunggulan m-5">
            <h2 class="text-center">Our Advantages</h2>
        </div>
        <div class="keunggulan mx-auto mb-5" style="width: 80rem;">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card">
                        <img src="storage/order.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Doorstep Delivery</h5>
                            <p class="card-text">Your order is ready for a seamless delivery right to your doorstep! No need to step out of your room, just place your order, and we'll take care of the rest.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="storage/coffee.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Decadent Dessert Variety</h5>
                            <p class="card-text">Discover an array of tantalizing desserts sourced straight from Japan, featuring an enticing selection that's sure to delight your taste buds.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="storage/fastfood.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Ready-to-Eat Meals</h5>
                            <p class="card-text">To complement your dessert indulgence, we also offer a selection of ready-to-eat meals. Pair our tasty, affordable meals with your desserts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
        </section>
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="#" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                        <img src="{{ asset('storage/coffee-logo.png') }}" alt="Logo" width="32">
                        </svg>
                    </a>
                    <span class="mb-3 mb-md-0 text-muted">&copy; 2024 Kyou Cafe, Inc</span>
                </div>
    
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href=""><i class="fa-brands fa-twitter fa-xl"></i>
                        </a></li>
                    <li class="ms-3"><a class="text-muted" href="">
                            <i class="fa-brands fa-instagram fa-xl"></i>
                        </a></li>
                    <li class="ms-3"><a class="text-muted" href=""><i class="fa-brands fa-square-facebook fa-xl"></i>
                        </a></li>
                </ul>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
            integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
        </script>
    </body>
</html>
