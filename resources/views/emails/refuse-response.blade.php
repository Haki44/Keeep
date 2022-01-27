@component('mail::message')
Bonjour {{ $reply->user->firstname }},<br>

Nous sommes désolés, {{ $reply->offer->user->firstname }} a refusé votre réponse concernant l'offre {{ $reply->offer->name }}.<br>

A bientôt,<br>
L'équeeep
@endcomponent
