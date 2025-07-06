<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }} - Product Details</title>
</head>
<body>
    <h1>{{ $product->name }}</h1>

    <p><strong>Price:</strong> {{ $product->price }} DZD</p>
    <p><strong>Category:</strong> {{ $product->category->name }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>

    <h3>Images:</h3>
    @if($product->images->count())
        @foreach($product->images as $image)
            <img src="{{ asset('storage/' . $image->image_path) }}" width="150" style="margin: 10px;">
        @endforeach
    @else
        <p>No images available.</p>
    @endif

    <a href="/products/{{ $product->id }}/edit">Edit this product</a>
</body>
</html>
