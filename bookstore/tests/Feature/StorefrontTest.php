<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorefrontTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_and_catalog_are_accessible(): void
    {
        $category = Category::create([
            'name' => 'Engineering',
            'description' => 'Technical titles',
        ]);

        Book::create([
            'category_id' => $category->id,
            'title' => 'Testing Laravel Screens',
            'author' => 'Ava Brook',
            'isbn' => '1111111111111',
            'description' => 'Example description',
            'price' => 19.99,
            'stock' => 3,
            'featured' => true,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Leaf & Ledger')
            ->assertSee('Testing Laravel Screens');

        $this->get('/books?search=Laravel')
            ->assertOk()
            ->assertSee('Testing Laravel Screens');
    }
}
