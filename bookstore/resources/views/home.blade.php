@extends('layouts.app', ['title' => 'Leaf & Ledger'])

@section('content')
    <section class="hero editorial-hero">
        <div class="hero-copy-panel">
            <p class="eyebrow">Independent Reading Room</p>
            <h1>A bookstore experience shaped like a quiet, curated reading room.</h1>
            <p class="hero-copy">
                Leaf & Ledger brings together searchable shelves, curated categories,
                staff-friendly inventory controls, and live reading recommendations in one place.
            </p>

            <div class="hero-actions">
                <a class="button" href="{{ route('books.index') }}">Browse the shelves</a>
                <a class="button button-ghost" href="{{ route('admin.login') }}">Staff sign in</a>
            </div>

            <div class="hero-notes">
                <article>
                    <span>01</span>
                    <p>Browse thoughtful collections with fast search and clean navigation.</p>
                </article>
                <article>
                    <span>02</span>
                    <p>Keep pricing, stock, and featured titles organized behind the counter.</p>
                </article>
            </div>
        </div>

        <div class="hero-showcase">
            <div class="hero-stack-card feature-card">
                <p class="eyebrow">Shelf Snapshot</p>
                <div class="stat-grid">
                    <article>
                        <strong>{{ $latestBooks->count() }}</strong>
                        <span>Fresh arrivals</span>
                    </article>
                    <article>
                        <strong>{{ $categories->count() }}</strong>
                        <span>Categories</span>
                    </article>
                    <article>
                        <strong>{{ $featuredBooks->where('stock', '>', 0)->count() }}</strong>
                        <span>Featured now</span>
                    </article>
                </div>
            </div>

            @if($featuredBooks->isNotEmpty())
                @php($heroBook = $featuredBooks->first())
                <article class="hero-book-card">
                    <img src="{{ $heroBook->cover_url ?: 'https://placehold.co/800x1000/1b2a41/f4eadf?text=Leaf+%26+Ledger' }}" alt="{{ $heroBook->title }} cover">
                    <div class="hero-book-copy">
                        <span class="pill">{{ $heroBook->category?->name ?? 'Featured' }}</span>
                        <h3>{{ $heroBook->title }}</h3>
                        <p>{{ $heroBook->author }}</p>
                        <strong>Rs. {{ number_format((float) $heroBook->price, 2) }}</strong>
                    </div>
                </article>
            @endif
        </div>
    </section>

    <section class="section spotlight-band">
        <div class="section-head split-heading">
            <div>
                <p class="eyebrow">Editor’s Picks</p>
                <h2>Featured titles that deserve the front table</h2>
            </div>
            <p class="section-intro">A calm editorial layout helps the catalog feel more like a real bookstore than a plain product grid.</p>
        </div>

        <div class="featured-ribbon">
            @foreach($featuredBooks as $index => $book)
                <article class="book-card ribbon-card" style="--card-offset: {{ $index }};">
                    <img src="{{ $book->cover_url ?: 'https://placehold.co/800x1000/f3e5d8/6d584d?text=No+Cover' }}" alt="{{ $book->title }} cover">
                    <div class="book-card-body">
                        <div class="book-card-topline">
                            <span class="pill">{{ $book->category?->name ?? 'General' }}</span>
                            <span class="serial">0{{ $index + 1 }}</span>
                        </div>
                        <h3>{{ $book->title }}</h3>
                        <p>{{ $book->author }}</p>
                        <div class="book-card-footer">
                            <strong>Rs. {{ number_format((float) $book->price, 2) }}</strong>
                            <a class="text-link" href="{{ route('books.show', $book) }}">Open book</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section category-stage">
        <div class="section-head split-heading">
            <div>
                <p class="eyebrow">Browse by Mood</p>
                <h2>Categories with a little more presence</h2>
            </div>
        </div>

        <div class="category-grid editorial-categories">
            @foreach($categories as $loopIndex => $category)
                <article class="category-card mood-card">
                    <small class="category-count">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</small>
                    <h3>{{ $category->name }}</h3>
                    <p>{{ $category->description }}</p>
                    <span>{{ $category->books_count }} books on this shelf</span>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section api-stage">
        <div class="section-head split-heading">
            <div>
                <p class="eyebrow">Reading Discovery</p>
                <h2>External library recommendations</h2>
            </div>
            <p class="section-intro">Fresh recommendations add a sense of discovery while the page stays graceful even when that feed is unavailable.</p>
        </div>

        @if(count($externalBooks))
            <div class="card-grid discovery-grid">
                @foreach($externalBooks as $book)
                    <article class="book-card compact discovery-card">
                        @if($book['cover_url'])
                            <img src="{{ $book['cover_url'] }}" alt="{{ $book['title'] }} cover">
                        @endif
                        <div class="book-card-body">
                            <span class="pill">External Library</span>
                            <h3>{{ $book['title'] }}</h3>
                            <p>{{ $book['author'] }}</p>
                            <div class="book-card-footer">
                                <small>{{ $book['year'] ?? 'Unknown year' }}</small>
                                @if($book['link'])
                                    <a class="text-link" href="{{ $book['link'] }}" target="_blank" rel="noreferrer">View source</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h3>External recommendations are unavailable right now.</h3>
                <p>The layout still holds together cleanly while the API section waits for fresh data.</p>
            </div>
        @endif
    </section>
@endsection
