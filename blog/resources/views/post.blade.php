@extends('layout')
@section('content')
    <article>
        <h1>{{ $post->title }}</h1>
        <p>
            {!! $post->body !!}
        </p>
        <p>
            <a href="#">{{ $post->category->name }}</a>
        </p>
    </article>
    <a href="/">Go back</a>
@endsection