<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categories = collect([
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Hands-on guides for modern application architecture.',
            ],
            [
                'name' => 'Productivity',
                'slug' => 'productivity',
                'description' => 'Books that help teams ship work with clarity.',
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'Readable, thoughtful books for interface and brand work.',
            ],
        ])->mapWithKeys(fn (array $category) => [
            $category['name'] => Category::query()->updateOrCreate(
                ['name' => $category['name']],
                $category,
            ),
        ]);

        User::query()->updateOrCreate(
            ['email' => 'admin@leafandledger.test'],
            [
                'name' => 'Store Admin',
                'is_admin' => true,
                'password' => Hash::make('password'),
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'reader@leafandledger.test'],
            [
                'name' => 'Curious Reader',
                'is_admin' => false,
                'password' => Hash::make('password'),
            ],
        );

        $books = [
            [
                'title' => 'Laravel in Practice',
                'slug' => 'laravel-in-practice',
                'author' => 'Maya Benson',
                'isbn' => '9781000000001',
                'description' => 'A practical guide to building maintainable Laravel products with clean MVC structure.',
                'price' => 34.99,
                'stock' => 12,
                'featured' => true,
                'published_at' => '2024-03-10',
                'cover_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories['Web Development']->id,
            ],
            [
                'title' => 'Shipping Calm',
                'slug' => 'shipping-calm',
                'author' => 'Jordan Vale',
                'isbn' => '9781000000002',
                'description' => 'A team-focused handbook for sustainable delivery, planning, and execution.',
                'price' => 24.50,
                'stock' => 5,
                'featured' => true,
                'published_at' => '2023-11-04',
                'cover_url' => 'https://images.unsplash.com/photo-1516979187457-637abb4f9353?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories['Productivity']->id,
            ],
            [
                'title' => 'Designing Warm Interfaces',
                'slug' => 'designing-warm-interfaces',
                'author' => 'Elena Hart',
                'isbn' => '9781000000003',
                'description' => 'Patterns for building expressive user experiences without losing usability.',
                'price' => 29.00,
                'stock' => 8,
                'featured' => true,
                'published_at' => '2024-08-14',
                'cover_url' => 'https://images.unsplash.com/photo-1517842645767-c639042777db?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories['Design']->id,
            ],
            [
                'title' => 'Query Patterns for Builders',
                'slug' => 'query-patterns-for-builders',
                'author' => 'Nikhil Rao',
                'isbn' => '9781000000004',
                'description' => 'A quick reference for efficient relational querying and reporting.',
                'price' => 18.99,
                'stock' => 0,
                'featured' => false,
                'published_at' => '2022-06-21',
                'cover_url' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories['Web Development']->id,
            ],
            [
                'title' => 'Readable Product Specs',
                'slug' => 'readable-product-specs',
                'author' => 'Anika Stone',
                'isbn' => '9781000000005',
                'description' => 'Turn rough requirements into concise, testable implementation plans.',
                'price' => 21.75,
                'stock' => 15,
                'featured' => false,
                'published_at' => '2024-01-09',
                'cover_url' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories['Productivity']->id,
            ],
            [
                'title' => 'Layouts That Breathe',
                'slug' => 'layouts-that-breathe',
                'author' => 'Samira Cole',
                'isbn' => '9781000000006',
                'description' => 'A practical exploration of hierarchy, rhythm, and spacing for modern screens.',
                'price' => 27.40,
                'stock' => 4,
                'featured' => false,
                'published_at' => '2023-05-16',
                'cover_url' => 'https://images.unsplash.com/photo-1541963463532-d68292c34b19?auto=format&fit=crop&w=900&q=80',
                'category_id' => $categories['Design']->id,
            ],
        ];

        foreach ($books as $book) {
            Book::query()->updateOrCreate([
                'isbn' => $book['isbn'],
            ], $book);
        }
    }
}
