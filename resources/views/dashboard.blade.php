<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Offres') }}
        </h2>
    </x-slot>

    <livewire:offers-list />

</x-app-layout>
