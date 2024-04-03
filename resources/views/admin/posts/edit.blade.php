<x-layout>
    <x-setting heading="Edit Post: {{ $post->title }}">
        <form action="/admin/posts/{{ $post->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" value="{{ old('title', $post->title) }}" />
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" value="{{ old('thumbnail', $post->thumbnail) }}" 
                        :disable_required="1"
                        type="file" />
                </div>
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl ml-6"
                    width="50">
            </div>
            <x-form.input name="excerpt" value="{!! old('excerpt', $post->excerpt) !!}" type="textarea" />
            <x-form.input name="body" value="{!! old('body', $post->body) !!}" type="textarea" />

            <div class="mb-6">
                <label for="category_id" class="block mb-2 uppercase font-bold text-xs text-gray-700">Category</label>

                <select name="category_id" id="category_id">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ ucfirst($cat->name) }}
                        </option>
                    @endforeach
                </select>

                <x-form.error name="category"></x-form.error>
            </div>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
