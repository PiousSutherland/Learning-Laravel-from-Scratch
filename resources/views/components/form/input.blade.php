@props(['name', 'type' => 'text'])
<div class="mb-6">
    <label for="{{ $name }}" class="block mb-2 uppercase font-bold text-xs text-gray-700">
        {{ $name }}
    </label>
    @if ($type == 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" type="text"
            class="border border-gray-400 p-2 w-full rounded" value="{{ old($name) }}" required></textarea>
    @else
        <input name="{{ $name }}" id="{{ $name }}" type="{{ $type }}"
            value="@unless ($type == 'password'){{ old($name) }}@endunless"
            class="border border-gray-400 p-2 w-full rounded" autocomplete={{ $attributes }} required>
    @endif
    <x-form.error name="{{ $name }}" />
</div>
