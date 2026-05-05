<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Services\OpenLibraryService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(OpenLibraryService $openLibrary): View
    {
        return view('home', [
            'featuredBooks' => Book::query()
                ->with('category')
                ->where('featured', true)
                ->latest()
                ->take(3)
                ->get(),
            'latestBooks' => Book::query()
                ->with('category')
                ->latest()
                ->take(6)
                ->get(),
            'categories' => Category::query()
                ->withCount('books')
                ->orderBy('name')
                ->get(),
            'externalBooks' => $openLibrary->featuredBooks(),
        ]);
    }
}
