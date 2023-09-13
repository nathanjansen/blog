@php $posts = \App\Models\Post::all() @endphp

<x-layout>
    <div class="flex flex-col gap-4">
    @foreach($posts as $post)
        <div class="flex gap-2">
            <div>{{ $post->id }}</div>

            <div>
            @if ($post->isPublished())
                <a class="underline" href="{{ $post->route() }}">{{ $post->title }}</a>
            @else
                {{ $post->title }}
            @endif
            </div>
        </div>
    @endforeach
    </div>
</x-layout>
