<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Conversations') }}
        </h2>
    </x-slot>

    <livewire:conversations-list />

</x-app-layout>
