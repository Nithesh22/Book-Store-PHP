<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBookRequest;
use App\Http\Requests\Admin\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        return view('admin.books.index', [
            'books' => Book::query()
                ->with('category')
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.books.create', [
            'book' => new Book(),
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    public function store(StoreBookRequest $request): RedirectResponse
    {
        Book::create($request->validated());

        return redirect()->route('admin.books.index')
            ->with('status', 'Book created successfully.');
    }

    public function edit(Book $book): View
    {
        return view('admin.books.edit', [
            'book' => $book,
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validated());

        return redirect()->route('admin.books.index')
            ->with('status', 'Book updated successfully.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('status', 'Book deleted successfully.');
    }
}
