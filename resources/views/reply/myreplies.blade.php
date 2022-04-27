<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Mes transactions
        </h2>
    </x-slot>
    <div class="max-w-4xl px-2 mx-auto mt-6 md:max-w-full sm:px-6 lg:px-8">
        <div class="p-5 overflow-hidden bg-white shadow-sm lg:p-10 sm:rounded-lg">

            <div class="flex flex-wrap justify-center">

                    @forelse ($replies as $reply)
                        <div class="m-3 w-11/12 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 pt-4 flex flex-col items-center pb-10">
                                <h5 class="m-2 text-xl font-medium text-gray-900 dark:text-white">{{ $reply->user->firstname }} {{ $reply->user->name }}</h5>
                                <span class="m-2 text-sm text-gray-500 dark:text-gray-400">{{ $reply->reply }}</span>
                                <a href="{{route('reply.show', $reply->id)}}" class="m-2 inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-blue-800">Voir les détails de la transaction</a>
                            </div>
                        </div>


                    @empty
                        <tr class="block bg-gray-300 border border-grey-500 md:border-none md:table-row">
                            <td colspan="4" class="block p-2 text-left md:border md:border-grey-500 md:table-cell">Pas de réponse pour le moment</td>
                        </tr>
                    @endforelse

            </div>

        </div>
    </div>
</x-app-layout>
