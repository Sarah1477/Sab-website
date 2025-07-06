<h1>Edit Category</h1>
<form action="/categories/{{ $category->id }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $category->name }}" required>
    <button type="submit">Update</button>
</form>
