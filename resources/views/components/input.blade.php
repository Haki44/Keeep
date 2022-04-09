@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'shadow-sm border-0 border-b-2 border-black-900 focus:border-indigo-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 focus:text-']) !!}>
