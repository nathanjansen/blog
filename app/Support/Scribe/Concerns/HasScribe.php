<?php

namespace App\Support\Scribe\Concerns;

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

    public function __destruct()
    {
        static::$posts = [];
    }

    public function getRows()
    {
        return static::$posts;
    }
}
