<!DOCTYPE html>

<title>My Blog</title>
<link rel="stylesheet" href="/css/app.css">

<body>
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
</body>
