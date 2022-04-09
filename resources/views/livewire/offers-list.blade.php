<div>
    <div class="py-12">
        <div class="flex items-center justify-center">
            <div class="flex mb-4 border-2 rounded">
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

        <div class="flex flex-wrap max-w-6xl mx-auto sm:px-6 lg:px-8 justify-evenly">
            @foreach ($offers as $offer)
            <div class="w-1/4 h-auto m-1 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="h-full p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col justify-between w-full h-full">
                            <div>
                                <h3 class="text-xl">{{ $offer->name }}</h3>
                                <p class="text-xs">
                                    {{-- Check si l'offre est a la date d'aujourd'hui ou non --}}
                                    @if (date_format(new DateTime($offer->offer_day), 'Y-m-d') <= date_format(new DateTime(), 'Y-m-d'))
                                        <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-green-400 rounded-full">Disponible</span></p>
                                    @else
                                        <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-orange-400 rounded-full">Bientôt disponible</span></p>
                                    @endif
                                <p class="mt-2">{{ substr($offer->description, 0, 30) }}...</p>
                            </div>
                            <div class="flex justify-between mt-2">
                                <a href="{{ route('offer.show', $offer->id) }}" class="text-blue-500">Voir le detail</a>
                                <h6 class="flex justify-end font-bold">{{ $offer->price }} kips 
                                    @if ($offer->pricing != 0) / {{ $offer->pricing_name }} @endif 
                                </h6>
                            </div>
                            @can('manage-offer', $offer)
                                <div class="flex justify-between mt-2">
                                    <div x-data="{ open{{ $offer->id }}: false }">
                                        <button x-on:click="open{{ $offer->id }} = true" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Supprimer</button>
                                        <div x-show="open{{ $offer->id }}" class="fixed left-0 right-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto bg-black bg-opacity-25 h-modal md:h-full top-4 md:inset-0">
                                            <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <!-- Modal header -->
                                                    <div class="flex items-start justify-between p-5 border-b rounded-t">
                                                        <h3 class="text-xl font-semibold lg:text-2xl">
                                                            Suppression
                                                        </h3>
                                                        <button x-on:click="open{{ $offer->id }} = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-6 space-y-6">
                                                        <p>Voulez-vous vraiment supprimer l'offre "{{ $offer->name }}" ?</p>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                        <a href="{{ route('offer.destroy', $offer->id) }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Supprimer</a>
                                                        <button x-on:click="open{{ $offer->id }} = false" type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Annuler</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('offer.edit', $offer->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Modifier</a>
                                </div>
                            @endcan
                        </div>

                </div>
            </div>
            @endforeach
        </div>
        <div>
            <div class="flex justify-center w-screen mt-5">
                {{ $offers->links() }}
            </div>
        </div>
    </div>
</div>
