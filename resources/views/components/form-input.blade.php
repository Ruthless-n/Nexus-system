@props(['label', 'name', 'type' => 'text', 'placeholder' => null, 'maxlength' => null])

<div class="w-80 mx-auto">
    <label class="block font-medium text-sm text-gray-700">{{ $label }}</label>
    <input 
        type="{{ $type }}"
        wire:model="{{ $name }}"
        {{ $placeholder ? "placeholder=$placeholder" : '' }}
        {{ $maxlength ? "maxlength=$maxlength" : '' }}
        {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md']) }}
    >
    @error($name)
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>
