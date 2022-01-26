@component('mail::message')
Bonjour {{ $user_to->firstname }},<br>

{{ $user_from->firstname }} vous a répondu à votre message pour l'offre : {{ $offer->name }}.<br>

@component('mail::button', ['url' => route('private_message.index', ['offer' => $offer->id, 'user' => $user_from->id])])
Veuillez vous rendre sur Keeep pour lui répondre
@endcomponent

A bientôt,<br>
L'équeeep
@endcomponent
