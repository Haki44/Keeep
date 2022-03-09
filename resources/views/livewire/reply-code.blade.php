<div>
    {{-- rappel du code de chaque partie --}}
    <div class="max-w-6xl mx-auto mt-6 sm:px-6 lg:px-8">
        @if ($reply->user->id === Auth::user()->id && is_null($reply->started_at))
            <p class="p-1 text-lg font-semi-bold">Rappel de votre code à communiquer: {{$reply->starting_code}}</p>
        @elseif ($reply->user->id != Auth::user()->id && !is_null($reply->started_at) && is_null($reply->ended_at))
            <p class="p-1 text-lg font-semi-bold">Rappel de votre code à communiquer: {{$reply->ending_code}}</p>
        @endif
        <p>{{$status}}</p>
    </div>
    <div class="max-w-6xl pb-10 mx-auto mt-6 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center pt-2 pb-10 overflow-hidden bg-white shadow-sm">
            {{-- verif si trop d'essaie pour le premier code --}}
                {{-- 1er step quand le premier code doit etre saisie pour debuter la transaction --}}
                @if ($reply->user->id != Auth::user()->id && is_null($reply->started_at))
                    <div class="flex-column">
                        <p class="p-1 text-3xl font-semi-bold">Saisie du code: </p>
                            <!-- Saisie du code -->
                            <div class=" mt-3">
                                <x-label for="code" :value="__('Code à 4 chiffres')" />

                                <x-input id="code" class="block mt-1 w-full" type="number" name="code" wire:model="code" required />
                                @error('code') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-3" wire:click="checkCode">
                                    {{ __('Valider') }}
                                </x-button>
                            </div>
                        <p class="p-2 text-xl">Vérifier que le code saisi correspond à celui qui vous a été donné.</p>
                        @if ($reply->starting_code_count)
                            <p class="p-2 text-xl text-red-600">Code invalide</p>
                        @endif
                        <p class="p-2 text-xl">Il vous reste {{3 - $reply->starting_code_count}} essaies.</p>
                    </div>
                    {{-- 2e step quand le second code doit etre saisie pour finaliser la transaction --}}
                @elseif ($reply->user->id === Auth::user()->id && !is_null($reply->started_at) && is_null($reply->ended_at))
                    <div class="flex-column">
                        <p class="p-1 text-3xl font-semi-bold">Saisie du code: </p>
                            <!-- Saisie du code -->
                            <div class=" mt-3">
                                <x-label for="code" :value="__('Code à 4 chiffres')" />

                                <x-input id="code" class="block mt-1 w-full" type="number" name="code" wire:model="code" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-3" wire:click="checkCode">
                                    {{ __('Valider') }}
                                </x-button>
                            </div>
                        <p class="p-2 text-xl">Vérifier que le code saisi correspond à celui qui vous a été donné.</p>
                        @if ($reply->ending_code_count)
                            <p class="p-2 text-xl text-red-600">Code invalide</p>
                        @endif
                        <p class="p-2 text-xl">Il vous reste {{3 - $reply->ending_code_count}} essaies.</p>
                    </div>
                    @elseif ($reply->user->id != Auth::user()->id && !is_null($reply->started_at) && is_null($reply->ended_at))
                    {{-- Polling sur 3s , le .visible sert a trigger si l'onglet est afficher ou non pour economiser la data (par exemple si les utilisateur ne ferme jamais leurs onglet...) --}}
                        <div class="flex-column" wire:poll.3s.visible>
                            <p class="p-1 text-3xl font-semi-bold">En attente</p>
                        </div>
                    {{-- 3e Step quand la transaction est finaliser --}}
                @elseif (!is_null($reply->ended_at))
                    <div class="flex-column">
                        <p class="p-1 text-3xl font-semi-bold">La transaction est terminé</p>
                    </div>
                    {{-- S'affiche quand la transaction est en cours pour le partie qui n'a pas a saisir de code  --}}
                @else
                    <div class="flex-column">
                        <p class="p-1 text-3xl font-semi-bold">La transaction est en cours</p>
                    </div>
                @endif
        </div>
    </div>
</div>
