@extends('layout')

@section('content')
    @foreach ($posts as $post)
        <article>
            <h1>
                <a href="/posts/{{ $post->slug }}">
                    {{ $post->title }}
                </a>
            </h1>
            <h3 class="date"> {{ $post->date }}</h3>
            <div>
                {!! $post->excerpt !!}
            </div>      
            <p>
                <a href="#">{{ $post->category->name }}</a>
            </p>
            </article>
    @endforeach
@endsection