@props(['name', 'type' => 'text', 'value', 'disable_required' => 0])
@php
    if (empty($value)) {
        $value = old($name);
    }
@endphp
<div class="mb-6">
    <label for="{{ $name }}" class="block mb-2 uppercase font-bold text-xs text-gray-700">
        {{ $name }}
    </label>
    @if ($type == 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" type="text"
            class="border border-gray-400 p-2 w-full rounded" required>{{ $value }}</textarea>
    @else
        <input name="{{ $name }}" id="{{ $name }}" type="{{ $type }}"
            class="border border-gray-400 p-2 w-full rounded"
            value="@unless ($type == 'password'){{ $value }}@endunless"
            @unless ($disable_required) {{ 'required' }} @endunless
            autocomplete="{{ empty($attributes['autocomplete']) ? 'off' : $attributes['autocomplete'] }}">
    @endif
    <x-form.error name="{{ $name }}" />
</div>
