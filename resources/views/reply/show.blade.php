<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Transaction de l'offre : ") }} {{ $reply->offer->name }}
        </h2>
    </x-slot>

    @livewire('reply-code', ['reply'=>$reply])

    {{-- Recap de l'offre --}}
    <div class="max-w-6xl pb-10 mx-auto mt-6 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center pt-2 pb-10 overflow-hidden bg-white shadow-sm">
            <div class="flex-column">
                <p class="p-1 text-4xl font-semi-bold">Récapitulatif de l'offre</p>
                <p class="p-1 text-2xl font-semi-bold">Nom : {{ $reply->offer->user->firstname }} {{ $reply->offer->user->name[0] }}.  de {{$reply->offer->user->school->name}}</p>
            </div>
        </div>
        <hr>
        <div class="flex flex-col md:flex-row @if($reply->offer->img != null) justify-start @else justify-center @endif pb-4 overflow-hidden bg-white shadow-sm">
            @if ($reply->offer->img != null)
            <div class="pr-4 mx-auto md:mx-0">
                <img class="w-80" src="{{$_ENV["APP_URL"]}}/img/{{$reply->offer->img}}" alt="{{$reply->offer->name}}">
            </div>
            @endif
            <div class="flex items-center flex-column">
                <div class="flex-column">
                    <p class="p-2 text-4xl font-bold">{{ $reply->offer->name }}</p>
                    <p class="p-2 text-xl">Description : {{ $reply->offer->description }}</p>
                    <p class="p-2 text-xl">Prix : {{ $reply->offer->price }} Kips</p>
                    <p class="p-2 text-xl">Disponible le  : {{ date('d/m/Y', strtotime($reply->offer->offer_day)) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
