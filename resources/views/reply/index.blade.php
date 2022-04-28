<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Réponses à mes offres
        </h2>
    </x-slot>

    <div class="max-w-4xl px-2 mx-auto mt-6 md:max-w-full sm:px-6 lg:px-8">

        <div class="p-5 overflow-hidden bg-white shadow-sm lg:p-10 sm:rounded-lg">

            @forelse ($offers as $offer)
                <div class="flex flex-wrap justify-center">
                    <p class="my-2 text-2xl font-bold">Offre : {{ $offer->name }}</p>
                </div>
                    <div class="flex flex-wrap justify-center">
                        @forelse ($offer->replies as $reply)

                            <div class="m-3 w-11/12 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                <div class="px-4 pt-4 flex flex-col items-center pb-10">
                                    <h5 class="m-2 text-xl font-medium text-gray-900 dark:text-white">{{ $reply->user->firstname }} {{ $reply->user->name }}</h5>
                                    <span class="m-2 text-sm text-gray-500 dark:text-gray-400">{{ $reply->reply }}</span>
                                    @if ($offer->pricing !== 0)
                                        <p class="text-sm text-gray-500 dark:text-gray-400" >{{ $reply->quantity }} {{ $reply->quantity > 1 ? $offer->pricing_name . 's' : $offer->pricing_name }}</p>
                                    @endif

                                    @if ($reply->status === null)
                                    <div class="m-2 flex mt-4 space-x-3 lg:mt-6">
                                        <a href="{{route('reply.update', [$reply->id,1])}}" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-blue-800">Accepter</a>
                                        <a href="{{ route('reply.update', [$reply->id, 0]) }}" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-gray-900 bg-yellowkeeep-btn focus:ring-4 focus:outline-none focus:ring-gray-200">Refuser</a>
                                    </div>

                                    @elseif ($reply->status === 0)

                                    <p class="m-2 inline-flex items-center py-2 px-4 text-sm font-medium text-center text-gray-900 bg-yellowkeeep-disabled focus:ring-4 focus:outline-none focus:ring-gray-200">
                                            Offre refusée
                                    </p>

                                    @elseif ($reply->status === 1)

                                    <a href="{{route('reply.show', $reply->id)}}" class="m-2 inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-blue-800">Voir les détails de la transaction</a>

                                    @endif

                                </div>
                            </div>
                        @empty
                        <div class="m-3 w-11/12 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 pt-4 flex flex-col items-center pb-10">
                                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Pas de réponses pour le moment</h5>
                            </div>
                        </div>
                        @endforelse
                    </div>
            <hr class="m-3">
            @empty
                <p>Vous ne proposez pas d'offres pour le moment</p>
            @endforelse



        </div>
    </div>
</x-app-layout>
