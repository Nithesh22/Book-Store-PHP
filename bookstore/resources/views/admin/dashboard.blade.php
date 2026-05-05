@extends('layouts.app', ['title' => 'Admin Dashboard'])

@section('content')
    <section class="section-head">
        <div>
            <p class="eyebrow">Dashboard</p>
            <h1>Inventory control at a glance</h1>
        </div>
        <a class="button" href="{{ route('admin.books.create') }}">Add new book</a>
    </section>

    <div class="stat-grid expanded">
        <article><strong>{{ $stats['books'] }}</strong><span>Total books</span></article>
        <article><strong>{{ $stats['categories'] }}</strong><span>Categories</span></article>
        <article><strong>{{ $stats['admins'] }}</strong><span>Admin users</span></article>
        <article><strong>{{ $stats['availableInventory'] }}</strong><span>Units in stock</span></article>
    </div>

    <section class="section two-column">
        <div class="panel">
            <div class="section-head">
                <div>
                    <p class="eyebrow">Watchlist</p>
                    <h2>Low stock</h2>
                </div>
            </div>

            <div class="list-stack">
                @forelse($lowStockBooks as $book)
                    <article class="list-item">
                        <div>
                            <strong>{{ $book->title }}</strong>
                            <p>{{ $book->author }}</p>
                        </div>
                        <span class="pill">{{ $book->stock }} left</span>
                    </article>
                @empty
                    <p>No low-stock items right now.</p>
                @endforelse
            </div>
        </div>

        <div class="panel">
            <div class="section-head">
                <div>
                    <p class="eyebrow">Recently Added</p>
                    <h2>Latest records</h2>
                </div>
            </div>

            <div class="list-stack">
                @foreach($recentBooks as $book)
                    <article class="list-item">
                        <div>
                            <strong>{{ $book->title }}</strong>
                            <p>{{ $book->published_at?->format('M d, Y') ?? 'No publish date' }}</p>
                        </div>
                        <a class="text-link" href="{{ route('admin.books.edit', $book) }}">Edit</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
