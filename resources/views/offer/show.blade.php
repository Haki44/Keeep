<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Détails de l'offre : ") }} {{ $offer->name }}
        </h2>
    </x-slot>

    <div class="max-w-6xl pb-10 mx-auto mt-6 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center pt-2 pb-10 overflow-hidden bg-white shadow-sm">
            <div class="flex-column">
                <p class="p-1 text-4xl font-semi-bold">Nom : {{ $offer->user->firstname }} {{ $offer->user->name[0] }}.  de {{$offer->user->school->name}}</p>
            </div>
        </div>
        <hr>
        <div class="flex flex-col md:flex-row @if ($offer->img != null) justify-start @else justify-center @endif pb-4 overflow-hidden bg-white shadow-sm">
            @if ($offer->img != null)
            <div class="pr-4 mx-auto md:mx-0">
                <img class="max-w-md" src="{{ Storage::url($offer->img) }}" alt="{{ $offer->name }}">
            </div>
            @endif
            <div class="flex items-center flex-column">
                <div class="flex-column">
                    <p class="p-2 text-4xl font-bold">{{ $offer->name }}</p>
                    <p class="p-2 text-xl">Description : {{ $offer->description }}</p>
                    <p class="p-2 text-xl">Prix : {{ $offer->price }} Kips @if ($offer->pricing !== 0)/ {{ $offer->pricing_name }}@endif</p>
                    <p class="p-2 text-xl">Disponible le  : {{ date('d/m/Y', strtotime($offer->offer_day)) }}</p>
                    <div class="flex flex-col items-center p-2"  x-data="{ open:{{$errors->isEmpty() ? 'false' :'open'}} }">
                        @if ($offer->user_id !== auth()->user()->id)
                            <a href="{{ route('private_message.create', $offer->id) }}" class="mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Contacter {{ $offer->user->firstname }} pour + de précisions</a>
                            @if (!is_null($reply) && is_null($reply->status))
                                <form  method="POST" action="{{ route('reply.destroy', $reply->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mb-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Annuler ma réponse</button>
                                </form>
                            @elseif (!is_null($reply) && $reply->status === 1 && is_null($offer->replies->last()->ended_at))
                                <div id="alert-1" class="flex p-4 mb-4 bg-green-100 rounded-lg" role="alert">
                                    <div class="ml-3 text-sm font-medium text-green-700">
                                        Vous ne pouvez plus annuler votre réponse car elle a été acceptée par <strong>{{ $offer->user->firstname }} {{ $offer->user->name[0] }}</strong>
                                    </div>
                                </div>
                            @endif
                        @endif

                        @if ((is_null($reply) || !is_null($offer->replies->last()->ended_at)) && $offer->user_id !== auth()->user()->id)
                            @if ($offer->price > auth()->user()->kips)
                                <div class="ml-3 text-m font-medium text-red-700">
                                    <p>Vous n'avez pas assez de Kips !</p>
                                </div>
                            @else
                                <a href="#" @click="open = !open" class="mb-2 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Acheter ( {{ $offer->price }} kips  @if ($offer->pricing !== 0)/ {{ $offer->pricing_name }}@endif)</a>
                            @endif

                            <div x-show="open" class="w-full sm:w-2/3">
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <form class="w-full sm:w-2/3" method="POST" action="{{ route('reply.store', $offer->id) }}">
                                    @csrf

                                    @livewire('offer-quantity', ['offer'=> $offer])
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
