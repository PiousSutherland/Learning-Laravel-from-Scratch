<x-layout>
    <x-slot name="content">
        @foreach ($posts as $post)
            <article>
                <h1>
                    <a href="/post/{{ $post->slug }}">
                        {{ $post->title }}
                    </a>
                </h1>
                <a href="/categories/{{ $post->category->slug }}">
                    Show {{ $post->category->name }} posts
                </a>
                <div>
                    <p>{{ $post->excerpt }}</p>
                </div>
            </article>
        @endforeach
    </x-slot>
</x-layout>
