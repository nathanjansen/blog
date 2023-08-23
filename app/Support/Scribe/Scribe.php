<?php

namespace App\Support\Scribe;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Support\Scribe\ScribeManager path(string $path)
 * @method static \App\Support\Scribe\ScribeManager registerArticles()
 * @method static \App\Support\Scribe\ScribeManager allArticleViews()
 * @method static \App\Support\Scribe\ScribeManager exists()
 * @method static \App\Support\Scribe\ScribeManager lastId()
 * @method static \App\Support\Scribe\ScribeManager freshId()
 * @method static string render($html)
 * @method static \App\Support\Scribe\ScribeManager compileBladeExpression()
 * @method static \App\Support\Scribe\ScribeManager registerBladeDirective()
 * @method static \App\Support\Scribe\ScribeManager registerBladeDirectives()
 * @method static \App\Support\Scribe\ScribeManager registerRoute()
 * @method static \App\Support\Scribe\ScribeManager registerPost()
 */
class Scribe extends Facade
{
    /**
     * {@inheritDoc}
     */
    public static function getFacadeAccessor(): string
    {
        return ScribeManager::class;
    }
}
