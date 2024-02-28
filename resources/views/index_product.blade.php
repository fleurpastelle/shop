<body>
    @foreach ($products as $product)
        <p>Name: {{ $product->name }}</p>
        <img src="{{ url('storage/' . $product->image) }}" alt="" height="100px">
        <form action="{{ route('show_product', $product) }}" method="get">
            <button type="submit">Show detail</button>
        </form>
        
        <form action="{{ route('delete_product', $product) }}" method="post">
            @method('delete')
            @csrf
            <button type="submit">Delete Product</button>
        </form>
    @endforeach
</body>
