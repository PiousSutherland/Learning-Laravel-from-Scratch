<x-layout>
    <div class="px-6 py-8">
        <x-panel class="max-w-sm mx-auto">
            <form action="/admin/posts" method="post">
                @csrf

                <div class="mb-6">
                    <label for="title" class="block mb-2 uppercase font-bold text-xs text-gray-700">Title</label>

                    <input name="title" id="title" type="text" class="border border-gray-400 p-2 w-full"
                        value="{{ old('title') }}" required>

                    @error('title')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="excerpt" class="block mb-2 uppercase font-bold text-xs text-gray-700">Excerpt</label>

                    <textarea name="excerpt" id="excerpt" type="text" class="border border-gray-400 p-2 w-full"
                        value="{{ old('excerpt') }}" required></textarea>

                    @error('excerpt')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="body" class="block mb-2 uppercase font-bold text-xs text-gray-700">Body</label>

                    <textarea name="body" id="body" type="text" class="border border-gray-400 p-2 w-full"
                        value="{{ old('body') }}" required></textarea>

                    @error('body')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="category_id"
                        class="block mb-2 uppercase font-bold text-xs text-gray-700">Category</label>

                    <select name="category_id" id="category_id">
                        @foreach (\App\Models\Category::all() as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ ucfirst($cat->name) }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <x-submit-button>Publish</x-submit-button>
            </form>
        </x-panel>
    </div>
</x-layout>
+
