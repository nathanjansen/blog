<?php

namespace App\Console\Commands;

use App\Support\Scribe\Scribe;
use Illuminate\Console\Command;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\text;

class MakeScribeCommand extends Command
{
    protected $signature = 'make:scribe {title?}';

    public function handle()
    {
        $title = text('What is the title of the article? You can always change this later.', default: $this->argument('title'));

        $freshId = Scribe::freshId();

        $slug = str($title)->slug();

        if (Scribe::exists($slug) && ! confirm('WARNING! The slug already exists. Do you still want to create it? This will overwrite the previous article route.')) {
            return;
        }

        $slug = text('Do you want to create a new article with the slug"?', default: $slug);

        $path = base_path('pages/articles/' . $freshId . '.' . $slug  . '.md');

        if (file_exists($path) && ! confirm('The file already exists. Do you want to overwrite it?')) {
            return;
        }

        $date = now()->format('Y-m-d');
        $author = config('scribe.default_author');
        $authorUrl = config('scribe.default_author_url');

        $body = <<<EOT
        ---
        id: $freshId
        title: $title
        date: $date
        author: $author
        authorUrl: $authorUrl
        published: true
        tags: []
        ---
        ##
        EOT;

        file_put_contents($path, $body);
    }
}
