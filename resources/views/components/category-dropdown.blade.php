<x-dropdown>
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 w-32 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
            {{ isset($currentCategory) ? ucfirst($currentCategory->name) : 'Categories' }}
            <x-down-arrow class="absolute pointer-events-none" style="right: 12px;" />
        </button>
    </x-slot>

    <x-dropdown-item href="/" :active="request('category') === null">All</x-dropdown-item>

    @foreach ($categories as $cat)
        <x-dropdown-item href="/?category={{ $cat->slug }}&{{ http_build_query(request()->except('category')) }}"
            :active="request('category') === $cat->slug">
            {{ ucfirst($cat->name) }}
        </x-dropdown-item>
    @endforeach
</x-dropdown>
