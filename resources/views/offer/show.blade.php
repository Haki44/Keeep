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
                <div class="flex p-2 flex-col items-center"  x-data="{ open:false }">
                    <a href="#" class="mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Contacter {{ $offer->user->firstname }} pour + de précisions</a>
                    <a href="#" @click="open = !open" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Acheter ({{ $offer->price }} kips)</a>

                    <dix x-show="open" class="w-full sm:w-2/3">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form class="w-full sm:w-2/3" method="POST" action="{{ route('reply.store', ['offer' => $offer->id]) }}">
                        @csrf
                            <div class="mt-4">
                                <x-label for="reply" value="Combien de jours / heures avez-vous besoin de cette offre ?*" />

                                <x-textarea class="w-full" name="reply" id="reply" :value="old('reply')" type="text" placeholder="Exemple : J'ai besoin de cette pelle pendant 2 heures"></x-textarea>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    Envoyer ma réponse à {{ $offer->user->firstname }}
                                </x-button>
                            </div>
                        </form>
                    </dix>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
