@props(['label', 'name', 'options' => []])

<div>
    <label class="block font-medium text-sm text-gray-700">{{ $label }}</label>
    <select wire:model="{{ $name }}" {{ $attributes->merge(['class' => 'border p-2 w-full mt-1']) }}>
        <option value="">Selecione uma opção</option>
        {{ $slot }}
    </select>
    @error($name)
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>