@php
    $selectedCategory = old('category_id', $book->category_id);
@endphp

<div class="form-grid">
    <label>
        <span>Title</span>
        <input type="text" name="title" value="{{ old('title', $book->title) }}" required>
    </label>

    <label>
        <span>Author</span>
        <input type="text" name="author" value="{{ old('author', $book->author) }}" required>
    </label>

    <label>
        <span>Category</span>
        <select name="category_id">
            <option value="">Uncategorized</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((string) $selectedCategory === (string) $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </label>

    <label>
        <span>ISBN</span>
        <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}">
    </label>

    <label>
        <span>Price (Rs.)</span>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $book->price) }}" required>
    </label>

    <label>
        <span>Stock</span>
        <input type="number" min="0" name="stock" value="{{ old('stock', $book->stock ?? 0) }}" required>
    </label>

    <label>
        <span>Published date</span>
        <input type="date" name="published_at" value="{{ old('published_at', optional($book->published_at)->format('Y-m-d')) }}">
    </label>

    <label>
        <span>Cover URL</span>
        <input type="url" name="cover_url" value="{{ old('cover_url', $book->cover_url) }}">
    </label>

    <label class="full-width">
        <span>Description</span>
        <textarea name="description" rows="6" required>{{ old('description', $book->description) }}</textarea>
    </label>

    <label class="checkbox">
        <input type="checkbox" name="featured" value="1" @checked(old('featured', $book->featured))>
        <span>Feature this book on the home page</span>
    </label>
</div>
