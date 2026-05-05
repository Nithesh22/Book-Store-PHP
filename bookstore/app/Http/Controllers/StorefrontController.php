<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StorefrontController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('search'));
        $category = trim((string) $request->string('category'));
        $availability = $request->string('availability')->toString();

        $books = Book::query()
            ->with('category')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($bookQuery) use ($search): void {
                    $bookQuery
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
                        ->orWhere('isbn', 'like', "%{$search}%");
                });
            })
            ->when($category !== '', function ($query) use ($category): void {
                $query->whereHas('category', function ($categoryQuery) use ($category): void {
                    $categoryQuery->where('slug', $category);
                });
            })
            ->when($availability === 'available', fn ($query) => $query->available())
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('books.index', [
            'books' => $books,
            'categories' => Category::query()->orderBy('name')->get(),
            'filters' => [
                'search' => $search,
                'category' => $category,
                'availability' => $availability,
            ],
        ]);
    }

    public function show(Book $book): View
    {
        return view('books.show', [
            'book' => $book->load('category'),
            'relatedBooks' => Book::query()
                ->with('category')
                ->whereKeyNot($book->id)
                ->when($book->category_id, fn ($query) => $query->where('category_id', $book->category_id))
                ->take(3)
                ->get(),
        ]);
    }
}
