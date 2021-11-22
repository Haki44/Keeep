<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Création d'un étudiant
        </h2>
    </x-slot>

    <div class="py-5">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="container px-10 mx-auto mb-4 lg:px-40" :errors="$errors" />

        <form action="{{ route('student.store') }}" method="POST" class="container px-10 mx-auto lg:px-40">
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