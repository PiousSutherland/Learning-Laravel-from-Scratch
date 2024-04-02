<x-layout>
    <div class="max-w-md mx-auto py-8">
        <h1 class="text-lg font-bold mb-4 ">
            Publish New Post
        </h1>
        <x-panel>
            <form action="/admin/posts" method="post" enctype="multipart/form-data">
                @csrf

                <x-form.input name="title"/>
                <x-form.input name="thumbnail" type="file"/>
                <x-form.input name="excerpt" type="textarea"/>
                <x-form.input name="body" type="textarea"/>

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

                    <x-form.error name="category"></x-form.error>
                </div>

                <x-form.button>Publish</x-form.button>
            </form>
        </x-panel>
    </div>
</x-layout>
+
