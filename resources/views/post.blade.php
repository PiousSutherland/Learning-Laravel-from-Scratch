<x-layout>
    <x-slot name="content">
        <article>
            <h1>
                <p>{{ $post->title }}</p>
            </h1>
            <a href="/category/{{ $post->category->slug }}">
                Show {{ $post->category->name }} posts
            </a>
            <div style="float: right; position:relative; top: -3rem;">
                <p>{{ $post->date }}</p>
            </div>
            <div>
                {!! $post->body !!}
            </div>
        </article>
        <a href="/">Go back</a>
    </x-slot>
</x-layout>
