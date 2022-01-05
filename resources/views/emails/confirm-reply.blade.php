@component('mail::message')
Bonjour {{ $reply['offer']->user->firstname }}, <br>

{{ auth()->user()->firstname }} vient de répondre à votre offre nommée : {{ $reply['offer']->name }} <br>

Avec les détails suivant : {{ $reply['data']['reply'] }}

Veuillez vous rendre sur Keeep pour <strong>accepter</strong> ou <strong>refuser</strong> la réponse.
@component('mail::button', ['url' => route('offer.show', $reply['offer']->id)])
    Cliquez ici pour accéder à l'offre
@endcomponent


A bientôt,<br>
L'équeeep
@endcomponent

