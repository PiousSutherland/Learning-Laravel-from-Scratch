<x-layout>
    <x-slot name="content">
        <article>
            <h1>
                {!! $post->title !!}
            </h1>
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
