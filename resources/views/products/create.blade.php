<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Product</title>
</head>
<body>
    <h1>Add New Product</h1>

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

    <form action="{{ url('/products') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Product Name:</label><br>
        <input type="text" name="name"><br><br>

        <label>Description:</label><br>
        <textarea name="description"></textarea><br><br>

        <label>Price (DZD):</label><br>
        <input type="number" name="price" step="0.01"><br><br>

        <label>Stock Quantity:</label><br>
        <input type="number" name="stock"><br><br>

        <label>Category:</label><br>
        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br><br>

        <label>Product Images:</label><br>
        <input type="file" name="images[]" multiple><br><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
