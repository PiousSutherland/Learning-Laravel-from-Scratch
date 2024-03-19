<x-layout>
    <x-slot name="content">
        @foreach ($posts as $post)
            <article>
                <h1>
                    <a href="/post/{{ $post->slug }}">
                        {{ $post->title }}
                    </a>
                </h1>
                By
                <a href="/authors/{{ $post->author->username }}">
                    {{ $post->author->name }}
                </a>
                in
                <a href="/categories/{{ $post->category->slug }}">
                    {{ $post->category->name }}
                </a>
                <div>
                    <p>{{ $post->excerpt }}</p>
                </div>
            </article>
        @endforeach
    </x-slot>
</x-layout>
