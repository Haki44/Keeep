<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Liste des réponses à mes offres
        </h2>
    </x-slot>

    <div class="max-w-4xl px-2 mx-auto mt-6 md:max-w-full sm:px-6 lg:px-8">

        <div class="p-5 overflow-hidden bg-white shadow-sm lg:p-10 sm:rounded-lg">

            
            @forelse ($offers as $offer)
                <p class="my-2 text-2xl font-bold">Offre : <span class="underline">{{ $offer->name }}</span></p>

                    <table class="block min-w-full mb-5 border-collapse md:table">
                        @if (count($offer->replies) != 0)
                            <thead class="block md:table-header-group">
                            <tr class="absolute block border border-grey-500 md:border-none md:table-row -top-full md:top-auto -left-full md:left-auto md:relative ">
                                <th class="block p-2 font-bold text-left text-white bg-indigo-600 md:w-2/12 md:border md:border-grey-500 md:table-cell">Prénom</th>
                                <th class="p-2 font-bold text-left text-white bg-indigo-600 md:w-2/12 justify-centerblock md:border md:border-grey-500 md:table-cell">Nom</th>
                                <th class="block p-2 font-bold text-left text-white bg-indigo-600 md:border md:border-grey-500 md:table-cell md:w-6/12">Message</th>
                                <th colspan="2" class="block p-2 font-bold text-left text-white bg-indigo-600 md:w-2/12 md:text-center md:border md:border-grey-500 md:table-cell">Actions</th>
                            </tr>
                            </thead>
                        @endif
                        <tbody class="block md:table-row-group">
                
                
                @forelse ($offer->replies as $reply)
                    <tr class="block bg-gray-300 border border-grey-500 md:border-none md:table-row">
                        <td class="block w-1/5 p-2 text-left md:w-2/12 md:border md:border-grey-500 md:table-cell"><span class="inline-block w-full font-bold md:hidden">Prénom</span>{{ $reply->user->firstname }}</td>
                        <td class="block w-1/5 p-2 text-left md:w-2/12 md:border md:border-grey-500 md:table-cell"><span class="inline-block w-full font-bold md:hidden">Nom</span>{{ $reply->user->name }}</td>
                        <td class="block w-full p-2 text-left md:border md:border-grey-500 md:table-cell md:w-6/12"><span class="inline-block w-full font-bold md:hidden">Message</span>Ils sont stocké ou les messages lors d'un achat d'offre ???</td>

                        {{-- En FullPage --}}
                        <td class="hidden w-full p-2 text-left md:block md:w-1/12 md:border md:border-grey-500 md:table-cell">
                            <a href="#" class="block md:flex md:justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#00561B">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </a>
                        </td>
                        <td class="hidden w-full p-2 text-left md:block md:w-1/12 md:border md:border-grey-500 md:table-cell">
                            <a href="{{ route('reply.refuse', $reply->id) }}" class="block md:flex md:justify-center" onclick="return confirm('Est-vous sur de refuser {{ $offer->name }} à {{ $reply->user->firstname }} ?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#f00020">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </td>

                        {{-- En Mobile --}}
                        <td class="block w-full p-2 md:mt-2 md:hidden">
                            <span class="inline-block w-1/3 font-bold md:hidden">Actions</span>
                            <span class="flex my-2">
                                <a href="#" class="flex w-1/2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#00561B">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Accepter
                                </a>
                                <a href="#" class="flex w-1/2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#f00020">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Refuser
                                </a>
                            </span>
                        </td>
                        
                    </tr>
                @empty
                    <tr class="block bg-gray-300 border border-grey-500 md:border-none md:table-row">
                        <td colspan="4" class="block p-2 text-left md:border md:border-grey-500 md:table-cell">Pas de réponse pour le moment</td>
                    </tr>
                @endforelse
                    </tbody>
                </table>

            @empty
                <p>Vous ne proposez pas d'offres pour le moment</p>
            @endforelse

            
            
        </div>
    </div>
</x-app-layout>