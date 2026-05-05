@extends('layouts.app', ['title' => 'Manage Books'])

@section('content')
    <section class="section-head">
        <div>
            <p class="eyebrow">Admin</p>
            <h1>Manage books</h1>
        </div>
        <a class="button" href="{{ route('admin.books.create') }}">Create book</a>
    </section>

    <div class="panel">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>
                            <strong>{{ $book->title }}</strong>
                            <small>{{ $book->author }}</small>
                        </td>
                        <td>{{ $book->category?->name ?? 'General' }}</td>
                        <td>Rs. {{ number_format((float) $book->price, 2) }}</td>
                        <td>{{ $book->stock }}</td>
                        <td class="table-actions">
                            <a class="text-link" href="{{ route('admin.books.edit', $book) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.books.destroy', $book) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination-wrap">
            {{ $books->links() }}
        </div>
    </div>
@endsection
