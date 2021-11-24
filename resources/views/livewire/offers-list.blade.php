<div>
    <div class="py-12">
        <div class="flex items-center justify-center">
            <div class="flex border-2 rounded mb-4">
                {{-- Utilisation du search du composant OfferList pour effectuer la recherche avec un temps d'attente de 500ms pour éviter le nb de requêtes  --}}
                <input type="text" class="px-4 py-2 w-80" placeholder="Rechercher une offre..." wire:model.debounce.500ms="search">
                <p class="flex items-center justify-center px-4 border-l">
                    <svg class="w-6 h-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                    </svg>
                </p>
            </div>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-evenly">
            @foreach ($offers as $offer)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/4 h-auto m-1">
                <div class="p-6 bg-white border-b border-gray-200 h-full">

                        <div class="w-full h-full flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl">{{ $offer->name }}</h3>
                                <p class="text-xs">le {{ date('d/m/Y', strtotime($offer->offer_day)); }}</p>
                                <p class="mt-2">{{ substr($offer->description, 0, 30); }}...</p>
                            </div>
                            <div class="flex justify-between mt-2">
                                <a href="#" class="text-blue-500">Voir le detail</a>
                                <h6 class="flex justify-end font-bold">{{ $offer->price }} kips</h6>
                            </div>
                        </div>

                </div>
            </div>
            @endforeach
        </div>
        <div>
            <div class="w-screen flex justify-center mt-5">
                {{ $offers->links() }}
            </div>
        </div>
    </div>
</div>
