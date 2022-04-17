<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Mes transactions
        </h2>
    </x-slot>
    <div class="max-w-4xl px-2 mx-auto mt-6 md:max-w-full sm:px-6 lg:px-8">
        <div class="p-5 overflow-hidden bg-white shadow-sm lg:p-10 sm:rounded-lg">
            <table class="block min-w-full mb-5 border-collapse md:table">
                <thead class="block md:table-header-group">
                    <tr class="absolute block border border-grey-500 md:border-none md:table-row -top-full md:top-auto -left-full md:left-auto md:relative ">
                        <th class="block p-2 font-bold text-left text-white bg-indigo-600 md:w-2/12 md:border md:border-grey-500 md:table-cell">Prénom</th>
                        <th class="p-2 font-bold text-left text-white bg-indigo-600 md:w-2/12 justify-centerblock md:border md:border-grey-500 md:table-cell">Nom</th>
                        <th class="block p-2 font-bold text-left text-white bg-indigo-600 md:border md:border-grey-500 md:table-cell md:w-6/12">Message</th>
                        <th colspan="2" class="block p-2 font-bold text-left text-white bg-indigo-600 md:w-2/12 md:text-center md:border md:border-grey-500 md:table-cell">Actions</th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                    @forelse ($replies as $reply)
                        <x-myreply :reply="$reply" />
                        {{-- <tr class="block bg-gray-300 border border-grey-500 md:border-none md:table-row">
                            <td class="block w-1/5 p-2 text-left md:w-2/12 md:border md:border-grey-500 md:table-cell"><span class="inline-block w-full font-bold md:hidden">Prénom</span>{{ $reply->user->firstname }}</td>
                            <td class="block w-1/5 p-2 text-left md:w-2/12 md:border md:border-grey-500 md:table-cell"><span class="inline-block w-full font-bold md:hidden">Nom</span>{{ $reply->user->name }}</td>
                            <td class="block w-full p-2 text-left md:border md:border-grey-500 md:table-cell md:w-6/12"><span class="inline-block w-full font-bold md:hidden">Message</span>{{ $reply->reply }}</td>
                            <td class="w-full p-2 text-left md:block md:w-2/12 md:border md:border-grey-500 md:table-cell">
                                <a href="{{route('reply.show', $reply->id)}}" class="text-white block bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Voir les détails de la transaction</a>
                            </td>
                        </tr> --}}
                    @empty
                        <tr class="block bg-gray-300 border border-grey-500 md:border-none md:table-row">
                            <td colspan="4" class="block p-2 text-left md:border md:border-grey-500 md:table-cell">Pas de réponse pour le moment</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
