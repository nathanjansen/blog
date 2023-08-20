<div {{ $attributes->class('border-l-4 border-primary-500 p-4 bg-primary-100') }}>
    @if ($title ?? null)
    <div {{ is_string($title) ? null : $title->attributes->class('text-2xl font-bold mb-4') }}>
        {{ $title }}
    </div>
    @endif

    {{ $slot }}
</div>
