<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class ScribeListCommand extends Command
{
    protected $signature = 'scribe:list';

    public function handle()
    {
        $this->table(
            ['#', 'Title', 'Route'],
            Post::all()->map(fn (Post $post) => [
                'id' => $post->id,
                'name' => $post->title,
                'route' => $post->route(),
            ])->toArray()
        );
    }
}
