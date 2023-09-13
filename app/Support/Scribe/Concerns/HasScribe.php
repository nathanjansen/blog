<?php

namespace App\Support\Scribe\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\HtmlString;
use Sushi\Sushi;

trait HasScribe
{
    use Sushi;

    protected static $posts = [];

    public static function register($post)
    {
        $post['state'] ??= 'published';

        static::$posts[] = $post;

        return $post;
    }

    public function render()
    {
        return new HtmlString(\App\Support\Scribe\Scribe::render($this->body));
    }

    public function __destruct()
    {
        static::$posts = [];
    }

    public function getRows()
    {
        return static::$posts;
    }

    public function isPublished()
    {
        return $this->state === 'published';
    }
}
