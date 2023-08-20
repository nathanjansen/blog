<?php

namespace App\Support\Scribe\Blade;

use Illuminate\View\Compilers\BladeCompiler;

class ScribeBladeCompiler extends BladeCompiler
{
    protected $skippedContent = [];

    public function compileString($value)
    {
        // Extract sections between <pre><code>...</code></pre>
        $pattern = '/<pre><code(.*?)<\/code><\/pre>/s';
        $value = preg_replace_callback($pattern, function($matches) {
            $placeholder = md5($matches[1]);
            $this->skippedContent[$placeholder] = $matches[1];
            return $placeholder; // Replace with a unique placeholder
        }, $value);

        // Compile the rest with Blade
        $compiled = parent::compileString($value);

        // Replace placeholders with original content
        foreach ($this->skippedContent as $placeholder => $original) {
            $compiled = str_replace($placeholder, '<pre><code' . $original . '</code></pre>', $compiled);
        }

        return $compiled;
    }
}
