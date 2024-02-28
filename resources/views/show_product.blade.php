<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $product->name }}</title>
</head>
<body>
    <a href="{{ route('index_product') }}">Back to Index Product</a>
    <p>Name: {{ $product->name }}</p>
    <p>Description: {{ $product->description }}</p>
    <p>Price: {{ $product->price }}</p>
    <p>Stock: {{ $product->stock }}</p>
    <img src="{{ url('storage/' . $product->image) }}" alt="" height="100px">
    <form action="{{ route('edit_product', $product) }}" method="get" style="margin-top: 20px;">
        <button type="submit">Edit Product</button>
    </form>
    <form action="{{ route('add_to_cart', $product) }}" method="post" style="margin-top: 20px;">
        @csrf
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" value="1">
        <button type="submit">Add to Cart</button>
    </form>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
</body>
</html>
