@extends('layouts.app', ['title' => 'Create Book'])

@section('content')
    <section class="section-head">
        <div>
            <p class="eyebrow">Admin</p>
            <h1>Add a new book</h1>
        </div>
    </section>

    <form method="POST" action="{{ route('admin.books.store') }}" class="panel stack">
        @csrf
        @include('admin.books._form')
        <button class="button" type="submit">Save book</button>
    </form>
@endsection
