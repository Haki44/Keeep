@component('mail::message')
Bonjour {{ $offer->user->firstname }},<br>

{{ $user_from->firstname }} vous a envoyée un message en lien avec votre offre {{ $offer->name }}.<br>

Veuillez vous rendre sur Keeep pour lui répondre.<br>

@component('mail::button',['url' => route('private_message.index', ['offer' => $offer->id, 'user' => $user_from->id])])
Répondre
@endcomponent

A bientôt,<br>
L'équeeep
@endcomponent
