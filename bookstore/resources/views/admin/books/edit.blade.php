@extends('layouts.app', ['title' => 'Edit Book'])

@section('content')
    <section class="section-head">
        <div>
            <p class="eyebrow">Admin</p>
            <h1>Edit {{ $book->title }}</h1>
        </div>
    </section>

    <form method="POST" action="{{ route('admin.books.update', $book) }}" class="panel stack">
        @csrf
        @method('PUT')
        @include('admin.books._form')
        <button class="button" type="submit">Update book</button>
    </form>
@endsection
