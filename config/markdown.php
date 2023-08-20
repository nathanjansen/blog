<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use League\CommonMark\Extension\CommonMark\Node\Block\Heading;

return [

    /*
    |--------------------------------------------------------------------------
    | Enable View Integration
    |--------------------------------------------------------------------------
    |
    | This option specifies if the view integration is enabled so you can write
    | markdown views and have them rendered as html. The following extensions
    | are currently supported: ".md", ".md.php", and ".md.blade.php". You may
    | disable this integration if it is conflicting with another package.
    |
    | Default: true
    |
    */

    'views' => false,

    /*
    |--------------------------------------------------------------------------
    | CommonMark Extensions
    |--------------------------------------------------------------------------
    |
    | This option specifies what extensions will be automatically enabled.
    | Simply provide your extension class names here.
    |
    | Default: [
    |              League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension::class,
    |              League\CommonMark\Extension\Table\TableExtension::class,
    |          ]
    |
    */

    'extensions' => [
        League\CommonMark\Extension\Attributes\AttributesExtension::class,
        League\CommonMark\Extension\Autolink\AutolinkExtension::class,
        League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension::class,
        League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension::class,
        League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension::class,
        League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension::class,
        League\CommonMark\Extension\Table\TableExtension::class,
        League\CommonMark\Extension\TaskList\TaskListExtension::class,
        Torchlight\Commonmark\V2\TorchlightExtension::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Renderer Configuration
    |--------------------------------------------------------------------------
    |
    | This option specifies an array of options for rendering HTML.
    |
    | Default: [
    |              'block_separator' => "\n",
    |              'inner_separator' => "\n",
    |              'soft_break'      => "\n",
    |          ]
    |
    */

    'renderer' => [
        'block_separator' => "\n",
        'inner_separator' => "\n",
        'soft_break'      => "\n",
    ],

    /*
    |--------------------------------------------------------------------------
    | Commonmark Configuration
    |--------------------------------------------------------------------------
    |
    | This option specifies an array of options for commonmark.
    |
    | Default: [
    |              'enable_em' => true,
    |              'enable_strong' => true,
    |              'use_asterisk' => true,
    |              'use_underscore' => true,
    |              'unordered_list_markers' => ['-', '+', '*'],
    |          ]
    |
    */

    'commonmark' => [
        'enable_em'              => true,
        'enable_strong'          => true,
        'use_asterisk'           => true,
        'use_underscore'         => true,
        'unordered_list_markers' => ['-', '+', '*'],
    ],

    /*
    |--------------------------------------------------------------------------
    | HTML Input
    |--------------------------------------------------------------------------
    |
    | This option specifies how to handle untrusted HTML input.
    |
    | Default: 'strip'
    |
    */

    'html_input' => 'allow',

    /*
    |--------------------------------------------------------------------------
    | Allow Unsafe Links
    |--------------------------------------------------------------------------
    |
    | This option specifies whether to allow risky image URLs and links.
    |
    | Default: true
    |
    */

    'allow_unsafe_links' => true,

    /*
    |--------------------------------------------------------------------------
    | Maximum Nesting Level
    |--------------------------------------------------------------------------
    |
    | This option specifies the maximum permitted block nesting level.
    |
    | Default: PHP_INT_MAX
    |
    */

    'max_nesting_level' => PHP_INT_MAX,

    /*
    |--------------------------------------------------------------------------
    | Slug Normalizer
    |--------------------------------------------------------------------------
    |
    | This option specifies an array of options for slug normalization.
    |
    | Default: [
    |              'max_length' => 255,
    |              'unique' => 'document',
    |          ]
    |
    */

    'slug_normalizer' => [
        'max_length' => 255,
        'unique'     => 'document',
    ],

    'heading_permalink' => [
        'html_class' => 'text-primary-500 opacity-50 group-hover:opacity-100 transition-opacity duration-200 ease-in-out',
        'id_prefix' => 'content',
        'insert' => 'before',
        'title' => 'Permalink',
        'symbol' => '#',
    ],

    'default_attributes' => [
        Heading::class => [
            'class' => static fn (Heading $node) => match($node->getLevel()) {
                2 => 'text-2xl -ml-7 text-3xl font-semibold flex gap-2 group',
                3 => 'text-xl -ml-5 font-semibold flex gap-2 group',
                default => null,
            },
        ],
        League\CommonMark\Extension\CommonMark\Node\Inline\Link::class => [
            'wire:navigate' => true,
            'class' => 'transition transition-all inline-flex items-center underline decoration-primary-500 underline-offset-1 hover:underline-offset-2',
        ],
        League\CommonMark\Extension\CommonMark\Node\Inline\Code::class => [
            'class' => 'text-base bg-gray-100 rounded border px-1',
        ],
        League\CommonMark\Extension\CommonMark\Node\Block\ListBlock::class => [],
    ],

    'disallowed_raw_html' => [
        'disallowed_tags' => ['title', 'textarea', 'style', 'xmp', 'iframe', 'noembed', 'noframes', 'script', 'plaintext', 'x-*'],
    ],
];