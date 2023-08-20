<?php

namespace App\Support\Scribe;

use Illuminate\Routing\Route;
use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Finder\SplFileInfo;

class MatchedArticle
{
    public function __construct(
        protected SplFileInfo $view,
        protected ?Document $object = null,
        protected array $post = [],
        protected ?Route $route = null,
    )
    {
        $this->object = YamlFrontMatter::parseFile($view->getPathname());
    }

    public function registerPost(): self
    {
        $this->post = $this->getPost(
            doc: $this->object,
            slug: $this->getSlug(
                id: $this->object->matter('id'),
                path: $this->getRelativePath()
            ),
        );

        Scribe::registerPost($this->post);

        return $this;
    }

    public function registerRoute(): self
    {
        $this->route = Scribe::registerRoute(config('scribe.articles') . '/{slug}');

        if ($this->object->matter('middleware')) {
            $this->route->middleware($this->object->matter('middleware'));
        }

        $this->route->name($this->post['name']);

        return $this;
    }

    protected function getPost(Document $doc, string $slug): array
    {
        $get = fn ($key, $default = null) => $doc->matter($key, $default);

        $published = $get('published', true);

        return [
            'id' => $get('id'),
            'title' => $get('title'),
            'date' => $get('date', now()->format('Y-m-d')),
            'author' => $get('author'),
            'slug' => $slug,
            'name' => $get('name', config('scribe.articles') . '.show'),
            'state' => $get('state', $published ? 'published' : 'draft'),
            'body' => $doc->body(),
            'tags' => json_encode($get('tags', [])),
        ];
    }

    public function getRelativePath(): string
    {
        return str($this->view->getPathname())
            ->afterLast(config('scribe.folder') . '/', '')
            ->replaceLast('.md', '')
            ->toString();
    }

    protected function getSlug($id, $path): string
    {
        return str($path)
            ->replace($id . '.', '')
            ->replaceFirst(config('scribe.articles') . '/', '')
            ->toString();
    }
}
