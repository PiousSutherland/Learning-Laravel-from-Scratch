<x-layout>
    <x-slot name="content">
        <article>
            <h1>
                <p>{{ $post->title }}</p>
            </h1>
            <p>
                By
                <a href="/authors/{{ $post->author->username }}">{{ $post->author->name }}</a>
                in
                <a href="/categories/{{ $post->category->slug }}">
                    {{ $post->category->name }}
                </a>
            </p>
            <div style="float: right; position:relative; top: -3rem;">
                <p>{{ $post->date }}</p>
            </div>
            <div>
                <p>
                    {!! $post->body !!}
                </p>
            </div>
        </article>
        <a href="/">Go back</a>
    </x-slot>
</x-layout>
