<?php

use App\Models\Post;
use function Laravel\Folio\name;

name('articles');

$posts = Post::current();

?>

<x-layout class="flex flex-col gap-8">

    <header>
        <h1 class="font-cal font-thin tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-primary-600 text-2xl text-white uppercase subpixel-antialiased rounded-md"
        >nathanjansen.dev</h1>
        <div class="text-gray-500 font-thin border-white">All things Laravel</div>
    </header>

    <div class="flex flex-col gap-16 mt-8">
        @foreach ($posts as $post)
            <article class="group relative flex flex-row justify-between items-center">
                <div>
                    <h2 class="font-extralight text-primary-500 text-xl tracking-tight dark:text-zinc-100 mt-0 mb-0">
                        <div
                            class="absolute -inset-x-4 -inset-y-6 z-0 scale-95 bg-primary-50 drop-shadow-sm opacity-50 opacity-0 transition transition-all duration-500 group-hover:scale-100 group-hover:opacity-100 dark:bg-zinc-800/50 sm:-inset-x-6 sm:rounded-2xl"></div>
                        <a href="{{ $post->route() }}"><span
                                class="absolute -inset-x-4 -inset-y-6 z-20 sm:-inset-x-6 sm:rounded-2xl"></span><span
                                class="relative z-10">{!! $post->title !!}</span></a></h2>
                    <time
                        class="font-thin relative z-10 flex items-center text-xs text-gray-400 dark:text-zinc-500"
                        datetime="2022-09-05">
                        {{ now()->parse($post->date)->format('F d, Y') }}
                    </time>
                </div>

                <div aria-hidden="true" class="transition transition-all duration-500 relative z-10 flex items-center text-sm font-extralight text-primary-500">
{{--                    <span class="transition transition-all duration-500 group-hover:border-primary-500 border-b border-white">Read article</span>--}}
                    <svg viewBox="0 0 16 16" fill="none" aria-hidden="true" class="ml-1 h-8 w-8 stroke-current">
                        <path d="M6.75 5.75 9.25 8l-2.5 2.25" stroke-width="0.5" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                    </svg>
                </div>
{{--                <p class="relative z-10 mt-2 text-sm text-zinc-600 dark:text-zinc-400">Most companies try to stay ahead--}}
{{--                    of the curve when it comes to visual design, but for Planetaria we needed to create a brand that--}}
{{--                    would still inspire us 100 years from now when humanity has spread across our entire solar--}}
{{--                    system.</p>--}}

            </article>
        @endforeach
    </div>
</x-layout>
