@extends('layouts.app', ['title' => $book->title])

@section('content')
    <section class="detail-layout detail-stage">
        <div class="detail-cover">
            <img src="{{ $book->cover_url ?: 'https://placehold.co/800x1000/f3e5d8/6d584d?text=No+Cover' }}" alt="{{ $book->title }} cover">
        </div>

        <div class="detail-body">
            <p class="eyebrow">{{ $book->category?->name ?? 'General' }}</p>
            <h1>{{ $book->title }}</h1>
            <p class="detail-author">by {{ $book->author }}</p>
            <p class="detail-copy">{{ $book->description }}</p>

            <div class="detail-meta">
                <article>
                    <small>Price</small>
                    <strong>Rs. {{ number_format((float) $book->price, 2) }}</strong>
                </article>
                <article>
                    <small>Availability</small>
                    <strong>{{ $book->stock > 0 ? $book->stock.' copies ready' : 'Out of stock' }}</strong>
                </article>
                <article>
                    <small>ISBN</small>
                    <strong>{{ $book->isbn ?: 'Not listed' }}</strong>
                </article>
            </div>
        </div>
    </section>

    @if($relatedBooks->isNotEmpty())
        <section class="section">
            <div class="section-head">
                <div>
                    <p class="eyebrow">More to Explore</p>
                    <h2>Related books</h2>
                </div>
            </div>

            <div class="card-grid discovery-grid">
                @foreach($relatedBooks as $relatedBook)
                    <article class="book-card compact discovery-card">
                        <img src="{{ $relatedBook->cover_url ?: 'https://placehold.co/800x1000/f3e5d8/6d584d?text=No+Cover' }}" alt="{{ $relatedBook->title }} cover">
                        <div class="book-card-body">
                            <h3>{{ $relatedBook->title }}</h3>
                            <p>{{ $relatedBook->author }}</p>
                            <a class="text-link" href="{{ route('books.show', $relatedBook) }}">View book</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
@endsection
