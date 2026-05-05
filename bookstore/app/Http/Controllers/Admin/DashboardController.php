<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'books' => Book::count(),
                'categories' => Category::count(),
                'admins' => User::where('is_admin', true)->count(),
                'availableInventory' => Book::sum('stock'),
            ],
            'lowStockBooks' => Book::query()
                ->where('stock', '<=', 5)
                ->orderBy('stock')
                ->take(5)
                ->get(),
            'recentBooks' => Book::query()
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
