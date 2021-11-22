<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-evenly">
            @foreach ($offers as $offer)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/4 h-auto m-1">
                <div class="p-6 bg-white border-b border-gray-200 h-full">

                        <div class="w-full h-full flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl">{{ $offer->name }}</h3>
                                <p class="text-xs">le {{ date('d/m/Y', strtotime($offer->offer_day)); }}</p>
                                <p class="mt-2">{{ substr($offer->description, 0, 30); }}...</p>
                            </div>
                            <div class="flex justify-between mt-2">
                                <a href="#" class="text-blue-500">Voir le detail</a>
                                <h6 class="flex justify-end font-bold">{{ $offer->price }} kips</h6>
                            </div>
                        </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
