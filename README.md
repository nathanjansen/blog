- https://github.com/spatie/yaml-front-matter
- https://github.com/snellingio/folio-markdown
- https://github.com/laravel/folio
- https://github.com/GrahamCampbell/Laravel-Markdown
- spatie/yaml-front-matter
- torchlight/torchlight-commonmark
- torchlight/torchlight-laravel
- calebporzio/sushi

## TODO
[ ] Have one place to manage the styling of components
[ ] Subtract Scribe as a separate package

## Using components in a .md file

You can use any blade component in your markdown file.
```md
<x-info>This is an info message</x-info>
```
## Register blade directives

So they can easily be used in markdown files.
Add this to your `AppServiceProvider` boot method:

```php
use Uteq\Scrib;

Scrib::registerBladeDirective('info');
```

## Livewire/volt
Is not yet fully supported
