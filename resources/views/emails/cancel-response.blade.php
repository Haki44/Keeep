@component('mail::message')
Bonjour {{ $reply->offer->user->firstname}},<br>

Nous sommes désolés, {{ $reply->user->firstname }} a annulé sa réponse concernant l'offre : {{ $reply->offer->name }}.<br>

A bientôt,<br>
L'équeeep
@endcomponent
