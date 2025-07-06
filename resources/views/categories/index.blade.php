<h1>All Categories</h1>
<a href="/categories/create">+ Add New</a>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<ul>
@foreach($categories as $category)
    <li>
        {{ $category->name }}
        <a href="/categories/{{ $category->id }}/edit">Edit</a>
        <form action="/categories/{{ $category->id }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Delete category?')" type="submit">Delete</button>
        </form>
    </li>
@endforeach
</ul>
