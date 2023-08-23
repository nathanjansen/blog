<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class OpenScribeCommand extends Command
{
    protected $signature = 'scribe:open {id}';

    public function handle()
    {
        $nodeScriptPath = resource_path('open-browser.js');

        $url = Post::find($this->argument('id'))->route();

        exec("node $nodeScriptPath $url", $output, $return_var);

        if ($return_var !== 0) {
            // Handle errors
            $this->error('Failed to run the Node.js script.');
            return 1;  // Non-zero exit code indicates an error
        }

        $this->info('Browser opened successfully.');
    }
}
