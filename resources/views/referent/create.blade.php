<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Création d'un référent
        </h2>
    </x-slot>

    <div class="py-5">
        <form action="{{ route('referent.store') }}" method="POST" class="container px-40 mx-auto">
            @csrf

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" value="Nom" />

                <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" autofocus required />
            </div>

            <!-- FirstName -->
            <div class="mt-4">
                <x-label for="firstname" value="Prénom" />

                <x-input id="firstname" class="block w-full mt-1" type="text" name="firstname" :value="old('firstname')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" value="Email" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
            </div>

             <!-- School -->
             <div class="mt-4">
                <x-label for="school" value="Ecole" />

                <x-input id="school" class="block w-full mt-1" type="text" name="school" :value="old('school')" required />
            </div>

            <div class="flex items-center mt-4">
                <x-button>
                    Créer
                </x-button>
            </div>
            
        </form>
    </div>
</x-app-layout>