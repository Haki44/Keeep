@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-normal text-lg text-gray-700 text-black']) }}>
    {{ $value ?? $slot }}
</label>
