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

    'markdown' => [

        /**
         * When you prefer Tailwind this is the best way to style your markdown.
         * Otherwise, you can add your own classes here
         * and add your styling to your css.
         *
         * Also check out https://commonmark.thephpleague.com/2.4/extensions/default-attributes/ for more options
         */
        'elements' => [
            'a' => [
                'class' => 'transition transition-all inline-flex items-center underline decoration-primary-500 underline-offset-1 hover:underline-offset-2',
                'wire:navigate' => true,
            ],
            'b' => ['class' => ''],
            'blockqoute' => ['class' => 'border-l-4 border-primary-500 pl-4 py-4 my-8 shadow-lg'],
            'checkbox' => ['class' => 'ring-2 ring-offset-2 ring-gray-100 checked:ring-primary-500 appearance-none w-3 h-3 border-gray-100 rounded-sm accent-emerald-500/25 checked:bg-primary-500 checked:border-gray-200'],
            'code' => ['class' => 'text-sm text-gray-600 bg-gray-100 px-2 py-0.5 rounded font-mono'],
            'em' => ['class' => ''],
            'hr' => ['class' => ''],
            'h1' => ['class' => ''],
            'h2' => ['class' => 'mt-16 mb-8 text-2xl -ml-7 text-3xl font-semibold flex gap-2 group'],
            'h3' => ['class' => 'mt-12 mb-4 text-xl -ml-5 font-semibold flex gap-2 group'],
            'h4' => ['class' => ''],
            'h5' => ['class' => ''],
            'h6' => ['class' => ''],
            'p' => ['class' => ''],
            'ol' => ['class' => ''],
            'ul' => ['class' => ''],
            'li' => ['class' => 'flex gap-2 items-center'],
            'table' => ['class' => ''],
            'html' => ['class' => ''],
        ],

        /**
         * For the full documentation of the markdown options, see:
         * https://commonmark.thephpleague.com/2.4/extensions/overview/
         */
        'extensions' => [
            'attributes' => [],
            'autolink' => [],
            'commonmark' => [],
            // Needs to be enabled for the elements to work
            'default_attributes' => [],
            'disallowed_raw_html' => [],
            'heading_permalink' => [],
            'table' => [],
            'task_list' => [],
            'torchlight' => [],
            'strikethrough' => [],

            // 'github_flavored' => [],
            // 'smart_punctuation' => [],
            // 'table_of_contents' => [],
            // 'description_list' => [],
            // 'embed' => [],
            // 'external_link' => [],
            // 'inlines_only' => [],
            // 'mentions' => [],
            // 'strikethrough' => [],
        ],
    ]
];
