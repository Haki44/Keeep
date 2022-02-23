@component('mail::message')
Bonjour {{ $user_to->firstname }},<br>

{{ $user_from->firstname }} à accepté(e) votre réponse.<br>

Veuillez vous rendre sur Keeep pour poursuivre la discussion.<br>

@component('mail::button', ['url' => route('private_message.index', [$offer->id, $user_from->id])])
Poursuivre la discution
@endcomponent

A bientôt,<br>
L'équeeep
@endcomponent
