<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Throwable;

class OpenLibraryService
{
    public function featuredBooks(string $query = 'classic literature', int $limit = 4): array
    {
        $cacheKey = "open-library-search:{$query}:{$limit}";
        $cached = Cache::get($cacheKey);

        if (is_array($cached) && count($cached) > 0) {
            return $cached;
        }

        $books = $this->fetchBooks($query, $limit);

        if (count($books) > 0) {
            Cache::put($cacheKey, $books, now()->addHours(6));
        }

        return $books;
    }

    protected function fetchBooks(string $query, int $limit): array
    {
        try {
            $response = Http::acceptJson()
                ->timeout(8)
                ->get('https://openlibrary.org/search.json', [
                    'q' => $query,
                    'limit' => $limit,
                ]);

            if ($response->failed()) {
                return [];
            }

            return collect($response->json('docs', []))
                ->filter(fn (array $book): bool => ! empty($book['title']))
                ->take($limit)
                ->map(function (array $book): array {
                    $coverId = $book['cover_i'] ?? null;
                    $workKey = $book['key'] ?? null;

                    return [
                        'title' => $book['title'] ?? 'Untitled',
                        'author' => data_get($book, 'author_name.0', 'Unknown author'),
                        'year' => $book['first_publish_year'] ?? null,
                        'cover_url' => $coverId
                            ? "https://covers.openlibrary.org/b/id/{$coverId}-L.jpg"
                            : null,
                        'link' => $workKey ? "https://openlibrary.org{$workKey}" : null,
                    ];
                })
                ->values()
                ->all();
        } catch (Throwable) {
            return [];
        }
    }
}
