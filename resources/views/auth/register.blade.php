<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register.store') }}">
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

            <!-- Postal Address -->
            <div class="mt-4">
                <x-label for="address" value="Adresse" />

                <x-input id="address" class="block w-full mt-1" type="text" name="address" :value="old('address')" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" value="N° Téléphone" />

                <x-input id="phone" class="block w-full mt-1" type="number" name="phone" :value="old('phone')" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" value="Email" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" value="Mot de passe" />

                <x-input id="password" class="block w-full mt-1"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="Confirmez le mot de passe" />

                <x-input id="password_confirmation" class="block w-full mt-1"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
                    Déjà inscrit ?
                </a>

                <x-button class="ml-4">
                    S'inscrire
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
