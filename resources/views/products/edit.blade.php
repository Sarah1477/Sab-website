<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ url('/products/' . $product->id . '/update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Product Name:</label><br>
        <input type="text" name="name" value="{{ $product->name }}"><br><br>

        <label>Description:</label><br>
        <textarea name="description">{{ $product->description }}</textarea><br><br>

        <label>Price (DZD):</label><br>
        <input type="number" step="0.01" name="price" value="{{ $product->price }}"><br><br>

        <label>Stock Quantity:</label><br>
        <input type="number" name="stock" value="{{ $product->stock }}"><br><br>

        <label>Category:</label><br>
        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Add New Images (optional):</label><br>
        <input type="file" name="images[]" multiple><br><br>

        <button type="submit">Update Product</button>
        
    </form>

<h3>Existing Images:</h3>
@foreach ($product->images as $image)
    <div style="margin-bottom: 10px;">
        <img src="{{ asset('storage/' . $image->image_path) }}" width="100" alt="product image">
        <form action="{{ url('/product-images/' . $image->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Delete this image?')" style="color:red;">Delete</button>
        </form>
    </div>
@endforeach

<hr>
<form action="{{ url('/products/' . $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product? This cannot be undone.')">
    @csrf
    @method('DELETE')
    <button type="submit" style="color:red;">Delete This Product</button>
</form>

</body>
</html>
