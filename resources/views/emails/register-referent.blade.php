@component('mail::message')
# Bonjour cher référent de {{ $referent->school->name }},<br>

Voici le lien pour pouvoir créer votre compte sur Keeep.fr<br>
@component('mail::button', ['url' => route('register', [$referent->id, $referent->register_token])])
M'inscrire
@endcomponent

A bientôt sur keeep.fr<br>

L'équeeep
@endcomponent
