<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Création d'un étudiant
        </h2>
    </x-slot>

    <div class="py-5">
        <form action="{{ route('student.store') }}" method="POST" class="container px-40 mx-auto">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" value="Email" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" autofocus required />
            </div>

            <div class="flex items-center mt-4">
                <x-button>
                    Créer
                </x-button>
            </div>
            
        </form>
    </div>
</x-app-layout>