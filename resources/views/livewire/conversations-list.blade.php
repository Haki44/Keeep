<div>
    <div class="max-w-4xl px-2 mx-auto mt-6 md:max-w-full sm:px-6 lg:px-8">

        <div class="p-5 overflow-hidden bg-white shadow-sm lg:p-10 sm:rounded-lg">

                <div class="py-12">

                    <div class="flex items-center justify-center">
                        <div class="flex border-2 rounded mb-4">
                            {{-- Utilisation du search du composant OfferList pour effectuer la recherche avec un temps d'attente de 500ms pour éviter le nb de requêtes  --}}
                            <input type="text" class="px-4 py-2 w-80" placeholder="Rechercher une conversation..." wire:model.debounce.500ms="search">
                            <p class="flex items-center justify-center px-4 border-l">
                                <svg class="w-6 h-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                                </svg>
                            </p>
                        </div>
                    </div>

                    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 flex flex-wrap flex-col justify-evenly">
                        @foreach ($users as $user)
                            <x-conversation :user="$user" />
                            {{-- <div class="border-solid border-2 border-sky-500 bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/4 h-auto m-1">
                                <div class="p-6 bg-white border-b border-gray-200 h-full">

                                        <div class="w-full h-full flex flex-row justify-around items-center">
                                            <div>
                                                <img src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144" alt="" class="w-10 h-10 rounded-full sm:w-16 sm:h-16">
                                            </div>
                                            <div>
                                                <h3 class="text-xl">{{ $user->name }} {{ $user->firstname }}</h3>
                                            </div>
                                        </div>
                                </div>
                            </div> --}}
                        @endforeach
                    </div>
                </div>

        </div>
    </div>
</div>
