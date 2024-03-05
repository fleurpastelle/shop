@extends('layouts.app')

@section('content')
    <div class="container" id="product" class="menu m-5">
        <h2><i class="fa-solid fa-mug-hot me-3"></i>Menu Produk</h2>       
        <hr>
        @if(Auth::check() && Auth::user()->is_admin)
        <a href="{{ route('create_product') }}" class="btn btn-dark">Create Product</a>
       @endif
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card yuji" style="width: 20rem;">
                        <img src="{{ url('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h4 class="py-2">IDR: Rp{{ number_format($product->price, 0, ',', '.') }}</h4>
                            <form action="{{ route('show_product', $product) }}" method="get">
                                <button type="submit" class="btn btn-dark gojo">Show Detail</button>
                            </form>
                            @if (Auth::check() && Auth::user()->is_admin)
                                <form action="{{ route('delete_product', $product) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger gojo mt-2">Delete product</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
