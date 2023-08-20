<?php

namespace App\Models;

use App\Support\Scribe\Concerns\HasScribe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Post extends Model
{
    use HasFactory, HasScribe;

    protected $casts = [
        'tags' => 'array',
    ];

    protected static $unguarded = true;

    public static function current(): Collection
    {
        return self::query()
            ->where('state', 'published')
            ->orderByDesc('date')
            ->get();
    }

    public function route()
    {
        return route('articles.show', $this->slug);
    }
}
