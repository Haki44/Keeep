<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Création d'une offre") }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex justify-center">
            <form class="w-2/3" method="POST" action="{{ route('offer.store') }}">
                @csrf

                <!-- Name -->
                <div class="mt-4">
                    <x-label for="name" value="Nom de l'offre" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus required />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-label for="description" value="Description" />

                    <x-textarea class="w-full" name="description" id="description" :value="old('description')" type="text" required ></x-textarea>
                </div>

                <!-- Date du post de l'offre -->
                <div class="mt-4">
                    <x-label for="offer_day" value="Date de l'offre" />

                    <x-input id="offer_day" class="block mt-1 w-full" type="date" name="offer_day" :value="old('offer_day')" />
                </div>

                <!-- Prix -->
                <div class="mt-4">
                    <x-label for="price" value="Prix (en kips)" />

                    <x-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" />
                </div>

                <!-- category_id -->
                <div class="mt-4">
                    <x-input id="category_id" class="block mt-1 w-full" type="hidden" name="category_id" value="1" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        Créer une offre
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
