<?php


return [
    /**
     * The folder in which the pages are stored.
     */
    'folder' => 'pages',

    /**
     * The folder in which the articles are stored.
     */
    'articles' => 'articles',

    /**
     * The default post model.
     */
    'post_model' => \App\Models\Post::class,

    /**
     * The default post author information.
     * This can be overridden in the front matter of the article.
     * The default author is used when no author is specified when creating a new article.
     */
    'default_author' => env('SCRIBE_DEFAULT_AUTHOR', ''),
    'default_author_url' => env('SCRIBE_DEFAULT_AUTHOR_URL', ''),

    // TODO implement this
    'markdown' => [
        'attributes' => [
            'block.heading.class' => [
                2 => '',
            ],
            'inline.link' => [
                'wire:navigate' => true,
                'class' => '',
            ],
        ],
    ],
];
