<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Conversations
        </h2>
    </x-slot>

    <div class="max-w-4xl px-2 mx-auto mt-6 md:max-w-full sm:px-6 lg:px-8">

        <div class="p-5 overflow-hidden bg-white shadow-sm lg:p-10 sm:rounded-lg">

            <div>
                <div class="py-12">

                    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 flex flex-wrap flex-col justify-evenly">
                        @foreach ($users as $user)
                        {{-- <a href="{{route('private_message.index', $user->id)}}"> --}}
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/4 h-auto m-1">
                                <div class="p-6 bg-white border-b border-gray-200 h-full">

                                        <div class="w-full h-full flex flex-col justify-between">
                                            <div>
                                                <h3 class="text-xl">{{ $user->name }}</h3>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        {{-- </a> --}}
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>