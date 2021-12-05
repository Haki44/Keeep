<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Détails de l'offre : ") }} {{ $offer->name }}
        </h2>
    </x-slot>

    <div class="pb-10 max-w-6xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="pt-2 pb-10 bg-white overflow-hidden shadow-sm flex flex-wrap justify-center">
            <div class="w-48">
                <img class="object-contain md:object-scale-down" src="{{ asset('img/default-pp.png') }}">
            </div>
            <div class="flex-column">
                <p class="text-4xl font-semi-bold p-1">Nom : {{ $offer->user->name }} {{ $offer->user->firstname }}</p>
                <p class="text-lg px-1">E-mail : {{ $offer->user->email }}</p>
                <p class="text-lg px-1">Téléphone : 
                    @if (isset($offer->user->phone))
                        {{ $offer->user->phone }}
                    @else
                        <span class="text-gray-400"> (non renseigné) </span>
                    @endif
                </p>
                <div class="text-lg px-1 flex flex-row">
                    <p>Note : </p>  
                    <img class="object-contain md:object-scale-down w-32 px-1" src="{{ asset('img/rate.png') }}">
                    <p class="text-gray-400">(34 évaluations)</p>  
                </div>
            </div>

        </div>
        <hr>
        <div class="pb-4 bg-white overflow-hidden shadow-sm flex flex-col items-center">
            <div class="w-full bg-gray-200 flex flex-col items-center">
                <img class="w-96 object-contain md:object-scale-down" src="{{ asset('img/raclette.jpg') }}">
            </div>
            <div class="flex-column">
                <p class="text-4xl font-bold p-2">{{ $offer->name }}</p>
                <p class="text-xl p-2">Description : {{ $offer->description }} Kips</p>
                <p class="text-xl p-2">Prix : {{ $offer->price }} Kips</p>
                <p class="text-xl p-2">Disponible le  : {{ date('d/m/Y', strtotime($offer->offer_day)) }} à {{ date('H:i', strtotime($offer->offer_day)) }}</p>
                <div class="flex p-2 flex-col items-center">                 
                    <button class="mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Contacter {{ $offer->user->firstname }} pour + de précisions</button>           
                    <button class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Acheter ({{ $offer->price }} kips)</button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>