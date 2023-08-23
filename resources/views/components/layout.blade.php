@props([
    'title' => config('app.name'),
    'meta' => null,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ $title }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! $meta !!}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body {{ $attributes->class(['max-w-3xl mx-auto my-4']) }}>

{{ $slot }}

<div class="max-w-xl mx-auto text-gray-500 font-thin mt-8">&copy; {{ date('Y') }} {{ str(config('app.url'))->replace('http://', '')->replace('https://', '') }}</div>
</body>
</html>
