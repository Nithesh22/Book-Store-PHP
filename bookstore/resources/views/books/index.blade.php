@extends('layouts.app', ['title' => 'Browse Books'])

@section('content')
    <section class="catalog-hero">
        <div>
            <p class="eyebrow">Storefront</p>
            <h1>Browse the catalog</h1>
            <p class="section-intro">Find titles by shelf, author, and availability in a calmer, easier-to-scan layout.</p>
        </div>
        <div class="catalog-badge">
            <span>{{ $books->total() }}</span>
            <small>books on the shelf</small>
        </div>
    </section>

    <form method="GET" class="filter-bar filter-shell">
        <input type="search" name="search" value="{{ $filters['search'] }}" placeholder="Search by title, author, or ISBN">
        <select name="category">
            <option value="">All categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->slug }}" @selected($filters['category'] === $category->slug)>{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="availability">
            <option value="">All stock states</option>
            <option value="available" @selected($filters['availability'] === 'available')>Available only</option>
        </select>
        <button class="button" type="submit">Apply filters</button>
    </form>

    <div class="catalog-grid">
        @forelse($books as $book)
            <article class="book-card catalog-card">
                <div class="catalog-cover">
                    <img src="{{ $book->cover_url ?: 'https://placehold.co/800x1000/f3e5d8/6d584d?text=No+Cover' }}" alt="{{ $book->title }} cover">
                </div>
                <div class="book-card-body">
                    <div class="book-card-topline">
                        <span class="pill">{{ $book->category?->name ?? 'General' }}</span>
                        <span class="catalog-stock {{ $book->stock > 0 ? 'in-stock' : 'sold-out' }}">
                            {{ $book->stock > 0 ? $book->stock.' in stock' : 'Sold out' }}
                        </span>
                    </div>
                    <h3>{{ $book->title }}</h3>
                    <p class="catalog-author">by {{ $book->author }}</p>
                    <div class="book-card-footer">
                        <strong>Rs. {{ number_format((float) $book->price, 2) }}</strong>
                        <a class="text-link" href="{{ route('books.show', $book) }}">Read more</a>
                    </div>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <h3>No books matched those filters.</h3>
                <p>Try broadening the search or switching to another shelf.</p>
            </div>
        @endforelse
    </div>

    <div class="pagination-wrap">
        {{ $books->links() }}
    </div>
@endsection
