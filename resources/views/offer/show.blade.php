<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Détails de l'offre : ") }} {{ $offer->name }}
        </h2>
    </x-slot>

    <div class="pb-10 max-w-6xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="pt-2 pb-10 bg-white overflow-hidden shadow-sm flex flex-wrap justify-center">
            <div class="flex-column">
                <p class="text-4xl font-semi-bold p-1">Nom : {{ $offer->user->name }} {{ $offer->user->firstname[0  ] }}</p>
            </div>
        </div>
        <hr>
        <div class="pb-4 bg-white overflow-hidden shadow-sm flex flex-col items-center">
            <div class="flex-column">
                <p class="text-4xl font-bold p-2">{{ $offer->name }}</p>
                <p class="text-xl p-2">Description : {{ $offer->description }} Kips</p>
                <p class="text-xl p-2">Prix : {{ $offer->price }} Kips</p>
                <p class="text-xl p-2">Disponible le  : {{ date('d/m/Y', strtotime($offer->offer_day)) }} à {{ date('H:i', strtotime($offer->offer_day)) }}</p>
                <div class="flex p-2 flex-col items-center">                 
                    <a href="#" class="mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Contacter {{ $offer->user->firstname }} pour + de précisions</a>
                    <a href="#" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Acheter ({{ $offer->price }} kips)</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>