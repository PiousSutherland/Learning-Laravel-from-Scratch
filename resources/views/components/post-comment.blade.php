@props(['comment', 'id'])
<article class="flex bg-gray-200 border-gray-300 p-3 rounded-xl">
    <div class="flex-shrink-0">
        <img src="https://i.pravatar.cc/60?u={{ $comment->author->id }}" alt="" width="60" height="60"
            class="rounded-xl">
    </div>

    <div class="ml-2">
        <header class="mb-4">
            <h3 class="font-bold">{{ $comment->author->username }}</h3>
            <p class="text-xs">
                Posted
                <time>{{ $comment->created_at }}</time>
            </p>
        </header>

        <p>
            {{ $comment->body }}
        </p>
    </div>
</article>
