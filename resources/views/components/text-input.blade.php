@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#3C004A] focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
