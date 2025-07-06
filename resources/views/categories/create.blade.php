<h1>Create Category</h1>
<form action="/categories" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Category name" required>
    <button type="submit">Create</button>
</form>
