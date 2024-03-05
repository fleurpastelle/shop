@include('layouts.navbar') <!-- Panggil navbar.blade.php -->

<div class="container mt-4">
    <div class="row row-produk justify-content-center">
        <div class="col-md-3">
            <figure>
                <img src="{{ url('storage/' . $product->image) }}" class="figure-img img-fluid"
                    style="border-radius: 5px; width: 450px;">
            </figure>
        </div>
        <div class="col-md-6">
            <h5 style="font-weight: bold;">{{ $product->name }}</h5>
            <h3 class="mb-2" style="font-weight: bold;">IDR {{ number_format($product->price, 0, ',', '.') }}</h3>
            <p class="mb-2">Sisa Stok: {{ $product->stock }}</p>
            <!-- Tambahkan tombol edit di sini -->
            @if(Auth::check() && Auth::user()->is_admin)
                <a href="{{ route('edit_product', $product) }}" class="btn btn-dark mb-3">Edit Product</a>
            @endif
            <div class="col-6 mt-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="deskripsi-tab" data-bs-toggle="tab"
                            data-bs-target="#deskripsi-tab-pane" type="button" role="tab"
                            aria-controls="deskripsi-tab-pane" aria-selected="true">Detail</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review-tab-pane"
                            type="button" role="tab" aria-controls="review-tab-pane" aria-selected="false"
                            review>Info Penting</button>
                    </li>
                </ul>
                <div class="tab-content p-3" id="myTabContent">
                    <div class="tab-pane fade show active deskripsi" id="deskripsi-tab-pane" role="tabpanel"
                        aria-labelledby="deskripsi-tab" tabindex="0">
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="tab-pane fade review" id="review-tab-pane" role="tabpanel" aria-labelledby="review-tab"
                        tabindex="0">
                        <h5>What is a Request Order?</h5>
                        <p>Request Order is a special menu that you want but not in our store, then prospective buyers
                            can chat us personally to ask questions about prices, description, etc.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mt-5" style="width: 19rem;">
                <div class="card-body">
                    <h5 class="card-title">Atur jumlah dan catatan</h5>
                    <span class="mt-3">{{ $product->name }}</span>
                    <hr>
                    <form action="{{ route('add_to_cart', $product) }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" aria-describedby="basic-addon2" name="amount"
                                value="1">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="submit">Add to cart</button>
                            </div>
                        </div>
                    </form>
                    <div class="mt-3 mb-3">
                        <strong class="text-primary mb-3"><i class="fa fa-pencil me-1"></i> Tambah catatan</strong>
                        <br>
                        <span class="text-muted">Sisa stok:</span>
                        <span class="fw-bold">{{ $product->stock }}</span>
                    </div>
                    <p class="mt-3">
                        <span><i class="fa-regular fa-message me-2"></i>Chat</span>
                        <span class="divider me-2"></span>
                        <span><i class="fa-regular fa-heart me-2"></i>Wish list</span>
                        <span class="divider me-2"></span>
                        <span><i class="fa-regular fa-share-from-square me-2"></i>Share</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
