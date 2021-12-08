<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Envoyer un message à #Utilisateur
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 sm:px-6 lg:px-8">
        <div class="flex justify-center p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            {{-- <form class="w-2/3" method="POST" action="{{ route('private_message.store') }}"> --}}
            <form class="w-2/3" method="POST" action="">
                @csrf

                <!-- Message -->
                <div class="mt-4">
                    <x-label for="content" value="Message *" />

                    <x-textarea class="w-full" name="content" id="content" :value="old('content')" type="text" required ></x-textarea>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        Envoyer
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>