@component('mail::message')
Bonjour {{ $offer->user->firstname }}, <br>

{{ $user_from->firstname}} vient de répondre à votre offre nommée : {{ $offer->name }} <br>

Avec les détails suivant : {{ $reply }}

Veuillez vous rendre sur Keeep pour <strong>accepter</strong> ou <strong>refuser</strong> la réponse.
@component('mail::button', ['url' => route('offer.show',$offer->id)])
    Cliquez ici pour accéder à l'offre
@endcomponent


A bientôt,<br>
L'équeeep
@endcomponent

