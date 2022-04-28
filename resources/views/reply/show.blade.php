<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Transaction de l'offre : ") }} {{ $reply->offer->name }}
        </h2>
    </x-slot>
    <div class="bg-white border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        @livewire('reply-code', ['reply'=>$reply])

        {{-- Recap de l'offre --}}
        <div class="max-w-6xl pb-10 mx-auto mt-6 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center pt-2 pb-10 overflow-hidden bg-white shadow-sm">
                <div class="flex-column">
                    <p class="p-1 text-3xl font-bold">Récapitulatif de l'offre : {{ $reply->offer->name }}</p>
                </div>
            </div>

            <div class="flex flex-col pb-4 overflow-hidden bg-white shadow-sm">
                @if ($reply->offer->img != null)
                    <img class="w-full" src="{{$_ENV["APP_URL"]}}/img/{{$reply->offer->img}}" alt="{{$reply->offer->name}}">
                @else
                    <img class="w-full" src="{{ asset('img/no_img.png') }}">
                @endif
                <div class="flex purple-keeep flex-col">
                    <div class="p-3 flex flex-row justify-around">
                        <p class="p-1 text-2xl font-semi-bold"> {{ $reply->offer->user->firstname }} {{ $reply->offer->user->name[0] }}</p>
                        <p class="p-1 text-2xl font-semi-bold"> {{$reply->offer->user->school->name}}</p>
                    </div>
                    <p class="p-2 text-xl">{{ $reply->offer->description }}</p>
                    <p class="p-2 text-xl">{{ $reply->offer->price }} Kips</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
