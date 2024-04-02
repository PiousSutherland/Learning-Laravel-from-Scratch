@auth
    <x-panel>
        <form action="/post/{{ $post->slug }}/comments" method="post">
            @csrf

            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="40" height="40"
                    class="rounded-full">
                <h2 class="ml-4">Want to participate?</h2>
            </header>
            <div class="mt-5">
                <textarea name="body" class="w-full text-sm p-2 focus:outline-none focus:ring" rows="5"
                    placeholder="Comment here" required></textarea>
                <x-form.error name="body"></x-form.error>
            </div>
            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                <x-form.button>Post</x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <h1>You have to <a href="/login" class="text-blue-600">log in</a> or <a href="/register"
            class="text-blue-600">register</a> to
        <strong>comment</strong>
    </h1>
@endauth