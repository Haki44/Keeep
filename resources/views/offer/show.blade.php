<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __($offer->name) }}
        </h2>
        <x-chip-dispo offerDay='{{$offer->offer_day}}' />
    </x-slot>

    <div class="max-w-6xl mx-auto">
        @if ($offer->img)
        <div class="justify-center mx-auto overflow-hidden h-52 lg:h-60 md:mx-0">
            <img class="max-w-md" src="{{ Storage::url($offer->img) }}" alt="Image de l'offre {{ $offer->name }}">
        </div>
        @else
            <div class="justify-center overflow-hidden bg-gray-300 h-52 lg:h-60">
            </div>
        @endif
    </div>
    <div class="flex items-center w-full max-w-6xl px-6 py-2 mx-auto bg-white lg:px-8">
        <div class="flex items-center w-1/2">
            <img class="w-10 h-10 rounded-full sm:w-16 sm:h-16" src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144" alt="photo profil {{ $offer->user->firstname }}">
            <p class="ml-2 text-xl font-semibold text-indigo-800">
                {{ $offer->user->firstname }} {{ strtoupper($offer->user->name[0]) }}.
            </p>
        </div>
        <div class="w-1/2">
            <p class="text-xl font-semibold text-center text-indigo-800">{{ ucfirst(strtolower($offer->user->school->name)) }}</p>
        </div>
    </div>
    <div class="flex flex-col justify-center h-full px-6 mt-5 bg-white flex-column md:flex-row">
        <p class="text-xl text-indigo-800">{{ $offer->description }}</p>

        <p class="my-8 text-2xl font-semibold text-indigo-800">{{ $offer->price }} Kips</p>

        <div class="flex flex-col items-center"  x-data="{ open:{{$errors->isEmpty() ? 'false' :'open'}} }">

            @if ((is_null($reply) || !is_null($offer->replies->last()->ended_at)) && $offer->user_id != auth()->user()->id)
                @if ($offer->price > auth()->user()->kips)
                    <div class="ml-3 font-medium text-red-700 text-m">
                        <p>Vous n'avez pas assez de Kips !</p>
                    </div>
                @else
                    @if (date_format(new DateTime($offer->offer_day), 'Y-m-d') >= date_format(new DateTime(), 'Y-m-d'))
                        <div class="w-full">
                            <x-button>Pas encore Disponible</x-button>
                        </div>
                    @else
                        <div class="w-full">
                            <x-button color="purple" type="click" :price="$offer->price" />
                        </div>
                    @endif
                @endif

                <div x-show="open" class="w-full sm:w-2/3">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form class="w-full sm:w-2/3" method="POST" action="{{ route('reply.store', $offer->id) }}">
                        @csrf

                        @livewire('offer-quantity', ['offer'=> $offer])
                    </form>
                </div>
            @endif
            
            <div class="my-2"></div>

            @if ($offer->user_id !== auth()->user()->id)
                <div class="w-full">
                    <x-button :route="route('private_message.create', $offer->id)">
                        Envoyer un message
                    </x-button>
                </div>
                @if (!is_null($reply) && is_null($reply->status))
                    <form  method="POST" action="{{ route('reply.destroy', $reply->id) }}">
                        @csrf
                        @method('DELETE')
                        <x-button type="submit" color="purple">Annuler ma réponse</x-button>
                    </form>
                @elseif (!is_null($reply) && $reply->status == 1 && is_null($offer->replies->last()->ended_at))
                    <div id="alert-1" class="flex p-4 mb-4 bg-green-100 rounded-lg" role="alert">
                        <div class="ml-3 text-sm font-medium text-green-700">
                            Vous ne pouvez plus annuler votre réponse car elle a été acceptée par <strong>{{ $offer->user->firstname }} {{ $offer->user->name[0] }}</strong>
                        </div>
                    </div>
                @endif
            @endif

        </div>
    </div>
</x-app-layout>
