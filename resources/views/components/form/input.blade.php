@props(['name', 'type' => 'text'])
<div class="mb-6">
    <label for="{{ $name }}" class="block mb-2 uppercase font-bold text-xs text-gray-700">
        {{ $name }}
    </label>
    @if ($type == 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" type="text" class="border border-gray-400 p-2 w-full"
            value="{{ old($name) }}" required></textarea>
    @else
        <input name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" value="{{ old($name) }}"
            class="border border-gray-400 p-2 w-full" required>
    @endif
    <x-form.error name="{{ $name }}" />
</div>
