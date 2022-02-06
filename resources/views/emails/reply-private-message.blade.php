@component('mail::message')
Bonjour {{ $user_to->firstname }},<br>

{{ $user_from->firstname }} vous a envoyé un message privé.<br>

@component('mail::button', ['url' => route('private_message.index', ['user' => $user_from->id])])
Veuillez vous rendre sur Keeep pour lui répondre
@endcomponent

A bientôt,<br>
L'équeeep
@endcomponent
