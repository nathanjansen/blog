<?php

namespace App\Support\Scribe;

use App\Support\Scribe\Blade\ScribeBladeCompiler;
use App\Support\Scribe\Exceptions\MissingElementException;
use Illuminate\Support\ServiceProvider;
use Laravel\Folio\FolioManager;
use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Block\HtmlBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Extension\CommonMark\Node\Block\ThematicBreak;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\CommonMark\Node\Inline\Emphasis;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use League\CommonMark\Extension\Table\Table;
use League\CommonMark\Extension\Table\TableCell;
use League\CommonMark\Extension\Table\TableRow;
use League\CommonMark\Extension\Table\TableSection;
use League\CommonMark\Extension\TaskList\TaskListItemMarker;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Node\Inline\Text;

class ScribeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Scribe::registerArticles();
    }

    public function register()
    {
        $this->app->singleton(FolioManager::class);

        $this->app->singleton('blade.compiler', fn() => new ScribeBladeCompiler(
            $this->app['files'],
            $this->app['config']['view.compiled']
        ));

        $nodesMap = [
            'a' => Link::class,
            'b' => Strong::class,
            'p' => Paragraph::class,
            'em' => Emphasis::class,
            'hr' => ThematicBreak::class,
            'blockqoute' => BlockQuote::class,
            'fenced' => Text::class,
            'html' => HtmlBlock::class,
            'code' => Code::class,

            // TODO this is not working
            'ul' => [
                'class' => ListBlock::class,
                'type' => ListBlock::TYPE_BULLET,
                'method' => static fn($node) => $node->type === ListBlock::TYPE_BULLET ? $value : ListBlock::class,
            ],
            'ol' => [
                'class' => ListBlock::class,
                'type' => ListBlock::TYPE_ORDERED,
            ],
            'li' => ListItem::class,
            'table' => Table::class,
            'tr' => TableRow::class,
            // TODO test this
            'head' => TableSection::class,
            'body' => TableSection::class,
            'td' => TableCell::class,
            'checkbox' => TaskListItemMarker::class,
        ];

        $heading = [];
        $heading[1] = config('scribe.markdown.elements.h1');
        $heading[2] = config('scribe.markdown.elements.h2');
        $heading[3] = config('scribe.markdown.elements.h3');
        $heading[4] = config('scribe.markdown.elements.h4');
        $heading[5] = config('scribe.markdown.elements.h5');
        $heading[6] = config('scribe.markdown.elements.h6');

        $output = collect($heading)->reduce(function ($carry, $attributes, $index) {
            foreach ($attributes as $key => $value) {
                $carry[$key][$index] = $value;
            }
            return $carry;
        }, []);

        foreach ($output as $key => $value) {
            config()->set(
                key: 'markdown.default_attributes.'. Heading::class .'.' . $key,
                value: static fn (Heading $node) => $value[$node->getLevel()] ?? null
            );
        }

//        foreach (config('scribe.markdown.elements.fenced', []) as $key => $value) {
//            config()->set(
//                key: 'markdown.default_attributes.' . FencedCode::class .'.' . $key,
//                value: static fn (FencedCode $node) => $node->data->set($key, $value)
//            );
//        }

        config()->set('markdown.default_attributes.' . FencedCode::class, [
            'class' => 'bg-primary-500',
            'data-attribute' => 'hi',
        ]);

        $skipAttributes = ['fenced', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

        foreach (config('scribe.markdown.elements') as $element => $attributes) {

            if (in_array($element, $skipAttributes)) {
                continue;
            }

            $node = $nodesMap[$element] ?? null;

            if ($node === null) {
                throw new MissingElementException("The element [$element] is not supported.");
            }

            if (is_array($node)) {
                continue;
                dd('different logic', $node);
            }

            config()->set(
                'markdown.default_attributes.' . $node,
                $attributes
            );
        }

//        dd(config('markdown.default_attributes'));
//
//        config()->set('markdown.default_attributes', $defaultAttributes);
    }
}
