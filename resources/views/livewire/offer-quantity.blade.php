@if ($offer->pricing !== 0)
    <div class="mt-4">
        <x-label for="quantity" value="Indiquez la quantité *" />
        <x-input id="quantity" class="block w-full mt-1" icon="offer" type="number" min="1" name="quantity" :value="$quantity" wire:keyup="modifiedQuantity($event.target.value)" />
        {{ $offer->price * $quantity }} Kips
        <div class="ml-3 font-medium text-red-700 text-m">
            <p>{{ $error_message }}</p>
        </div>
    </div>
@endif
<div class="mt-4">
    <x-label for="reply" value="Ajoutez des informations supplémentaires *" />
    <x-textarea class="w-full" name="reply" id="reply" :value="old('reply')" type="text" placeholder="Exemple : J'en aurais besoin pour mercredi"></x-textarea>
</div>
<div class="flex justify-center w-full">
    <x-button type="submit" color="purple">
        Envoyer ma réponse
    </x-button>
</div>