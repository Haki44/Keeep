<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Modification de") }} {{ $offer->name }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex justify-center">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form class="w-full sm:w-2/3" method="POST" action="{{ route('offer.update', $offer->id) }}">
                @csrf

                <!-- Name -->
                <div class="mt-4">
                    <x-label for="name" value="Nom de l'offre *" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $offer->name" autofocus />
                </div>

                <!-- Date du post de l'offre -->
                <div class="mt-4">
                    <x-label for="offer_day" value="Date à partir de laquelle l'offre est disponible *" />

                    <x-input id="offer_day" class="block mt-1 w-full" type="date" name="offer_day" :value="old('offer_day') ?? $offer->offer_day->format('Y-m-d')" />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-label for="description" value="Description de l'offre *" />

                    <x-textarea class="w-full" name="description" id="description" :value="old('description') ?? $offer->description" placeholder="Précisez vos disponibilités !" />
                </div>

                <!-- Prix -->
                <div class="mt-4">
                    <x-label for="price" value="Prix (en kips) *" />

                    <x-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price') ?? $offer->price" />
                </div>

                <!-- category_id -->
                <div class="mt-4">
                    <x-label for="category_id" value="Catégorie *" />

                    <x-select class="w-full" field="category_id" label="Catégories" :value="$offer->category_id" :values="$categories->pluck('name', 'id')" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        Modifier cette offre
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
