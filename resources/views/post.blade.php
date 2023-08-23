<x-layout class="flex flex-col gap-8">
    <aside class="flex justify-between">
        <div class="flex items-center gap-1">
            <span> « </span>
            <x-a href="{{ route('articles') }}">back</x-a>

            -
            <span class="text-gray-600">
                written by
                <x-a href="{{ $post->authorUrl }} }}"
                     target="_blank"
                >{{ $post->author }}</x-a>
                on {{ now()->parse($post->date)->format('F d, Y') }}
            </span>
        </div>

        <button x-convey-subscribe
             class="group transition transition-all duration-1000 flex gap-1 border-2 px-2 py-1 rounded-xl border-gray-400 text-gray-400 items-center hover:text-gray-600 hover:border-gray-600"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 class="transition transition-all duration-1000 animate-pulse w-5 h-5 group-hover:w-6 group-hover:h-6"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>

            <div>
                Subscribe
            </div>
        </button>
    </aside>

    <h1 class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-400 text-5xl leading-normal font-sans">
        {!! $post->title !!}
    </h1>

    <div class="text-xl leading-relaxed font-light text-gray-800">
        {!! $post->render() !!}
    </div>

    @if ($footnotes ?? null)
        <x-quote title="Footnotes">
            <div {{ $footnotes->attributes->class('flex flex-col gap-2 mt-4') }}>
                {{ $footnotes }}
            </div>
        </x-quote>
    @endif

    @if ($post->tags)
        <div class="flex gap-2 text-sm">
            @foreach ($post->tags as $tag)
                #{{ str($tag)->lower()->slug() }}
            @endforeach
        </div>
    @endif
</x-layout>
