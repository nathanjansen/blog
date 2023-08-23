- https://github.com/spatie/yaml-front-matter
- https://github.com/snellingio/folio-markdown
- https://github.com/laravel/folio
- https://github.com/GrahamCampbell/Laravel-Markdown
- spatie/yaml-front-matter
- torchlight/torchlight-commonmark
- torchlight/torchlight-laravel
- calebporzio/sushi

https://github.com/Ionaru/easy-markdown-editor
npm require open


Used as example for my Markdown editor
https://github.com/spatie/filament-markdown-editor

## TODO
[ ] Have one place to manage the styling of components
[ ] Subtract Scribe as a separate package

## Installation

You can install the package via composer:

```bash
composer require uteq/scribe
```



## Using components in a .md file

You can use any blade component in your markdown file.
```md
<x-info>This is an info message</x-info>
```

## Styling your markdown
By default, the markdown is styled using TailwindCSS. You can 
change this by publishing the config file and changing the 
`markdown` key in the `scribe.php` config file.

```php

## Livewire/volt
Is (not yet) fully supported
