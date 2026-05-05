<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminBookManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_and_delete_a_book(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
            'password' => 'password',
        ]);

        $category = Category::create([
            'name' => 'Operations',
            'description' => 'Operational titles',
        ]);

        $this->actingAs($admin)
            ->post(route('admin.books.store'), [
                'category_id' => $category->id,
                'title' => 'Warehouse Systems',
                'author' => 'Mina Fox',
                'isbn' => '2222222222222',
                'description' => 'A guide to stock movement.',
                'price' => 25.00,
                'stock' => 7,
                'featured' => true,
            ])
            ->assertRedirect(route('admin.books.index'));

        $book = Book::firstOrFail();

        $this->assertDatabaseHas('books', [
            'title' => 'Warehouse Systems',
            'slug' => 'warehouse-systems',
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.books.destroy', $book))
            ->assertRedirect(route('admin.books.index'));

        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }
}
