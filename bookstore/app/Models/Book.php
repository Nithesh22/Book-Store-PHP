<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author',
        'isbn',
        'description',
        'price',
        'stock',
        'cover_url',
        'published_at',
        'featured',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'published_at' => 'date',
            'featured' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Book $book): void {
            if (! $book->slug || $book->isDirty('title')) {
                $book->slug = Str::slug($book->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }
}
