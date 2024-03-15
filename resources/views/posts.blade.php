<x-layout>
    <x-slot name="content">
        @foreach ($posts as $post)
            <article>
                <h1>
                    <a href="/post/{{ $post->slug }}">
                        {{ $post->title }}
                    </a>
                </h1>
                <div>
                    {!! $post->excerpt !!}
                </div>
            </article>
        @endforeach
    </x-slot>
</x-layout>
