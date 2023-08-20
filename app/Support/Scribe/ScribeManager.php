<?php

namespace App\Support\Scribe;

use App\Models\Post;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\View\ComponentAttributeBag;
use Symfony\Component\Finder\Finder;

class ScribeManager
{
    protected ?string $mountPath = null;

    public function path(string $path)
    {
        $this->mountPath = $path;

        return $this;
    }

    public function registerArticles(): void
    {
        collect($this->allArticleViews())
            ->each(fn($view) => (new MatchedArticle($view))
                ->registerPost()
                ->registerRoute()
            );
    }

    public function allArticleViews(): Collection
    {
        $mountPath = $this->mountPath ?: resource_path('views/pages/articles');

        return collect(
            app(Finder::class)->in($mountPath)
                ->name('*.md')
                ->files()
        );
    }

    public function exists(string $slug): bool
    {
        return self::allArticleViews()
            ->filter(fn ($view) => str($view->getPathname())->contains($slug))
            ->count() > 0;
    }

    public function lastId(): ?int
    {
        $last = static::allArticleViews()
            ->sortDesc()
            ->first();

        if (! $last) {
            return null;
        }

        return str($last)->before('.')->afterLast('/')->toInteger();
    }

    public function freshId(): ?int
    {
        return static::lastId() ? (static::lastId() + 1) : 1;
    }

    public function render($post)
    {
        if (! $post->body) {
            return null;
        }

        $body = Markdown::convert($post->body);

        if (empty($body)) {
            return null;
        }

        return Blade::render((string) $body);
    }

    public function compileBladeExpression(string $expression)
    {
        $parts = explode(',', $expression);

        $slot = str($parts[0] ?? null)
            ->replaceFirst('\'', '')
            ->replaceLast('\'', '');

        $attributes = $parts[1] ?? '[]';
        eval("\$attributes = $attributes;");
        $attributes = (new ComponentAttributeBag($attributes))->toHtml();

        return [$slot, $attributes];
    }

    public function registerBladeDirective($directive)
    {
        Blade::directive($directive, function ($expression) use ($directive) {

            [$slot, $attributes] = $this->compileBladeExpression($expression);

            return Blade::compileString("<x-$directive $attributes>{$slot}</x-$directive>");
        });
    }

    public function registerBladeDirectives($directives)
    {
        $directives = is_array($directives) ? $directives : func_get_args();

        foreach ($directives as $directive) {
            static::registerBladeDirective($directive);
        }
    }

    public function registerRoute(string $uri): \Illuminate\Routing\Route
    {
        return Route::get($uri, function () {
            $post = config('scribe.post_model')::firstWhere('slug', request('slug'));

            if ($post?->state !== 'published') {
                abort(404);
            }

            return view('post', [
                'post' => Post::firstWhere('slug', request('slug')),
            ]);
        });
    }

    public function registerPost(array $post): array
    {
        return config('scribe.post_model')::register($post);
    }
}
