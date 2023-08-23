<x-layout class="max-w-full px-12">
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>

    <div class="flex items-center gap-1">
        <span> « </span>
        <x-a href="{{ route('articles') }}">back</x-a>
    </div>

    @volt('edit')
    <div
        class="flex gap-16 justify-center"
    >
        <div wire:ignore class="max-w-3xl shrink-0"
             x-data="{
                state: $wire.html,
                editor: null,

                debounce(func, timeout = 300) {
                    let timer;
                    return (...args) => {
                        clearTimeout(timer);
                        timer = setTimeout(() => {
                            func.apply(this, args);
                        }, timeout);
                    };
                },

                init() {
                    const editor = new EasyMDE({
                        element: document.getElementById('my-text-area'),
                    })

                    editor.codemirror.on('change', this.debounce(() => {
                        $wire.call('updateHtml', editor.value());
                    }));
                }
            }"
        >
            <textarea id="my-text-area">
                {{ $this->post->body }}
            </textarea>
        </div>

        <div class="max-w-3xl flex-grow">
            {!! $html !!}
        </div>
    </div>
    @endvolt
</x-layout>

<?php

use Livewire\Volt\Component;

new class extends Component {
    public $post;

    public string $html = 'Loading...';

    function mount($post)
    {
        $this->html = $post->render();
        $this->post = $post;
    }

    function updateHtml($html): void
    {
        $this->body = $html;
        $this->html = \App\Support\Scribe\Scribe::render($html);
    }
};
