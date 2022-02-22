@component('mail::message')
Bonjour {{ $user_to->firstname }},<br>

{{ $user_from->firstname }} à accepté(e) votre réponse.<br>

Veuillez vous rendre sur Keeep pour poursuivre la discussion.<br>
{{-- @component('mail::button', ['url' => route('offer.show', $offer->id)])
Répondre
@endcomponent --}}

A bientôt,<br>
L'équeeep
@endcomponent
