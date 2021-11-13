@component('mail::message')
# Bonjour cher étudiant de {{ $student->school->name }},<br>

Voici le lien pour pouvoir créer votre compte sur Keeep.fr<br>
@component('mail::button', ['url' => route('register', $student->register_token)])
M'inscrire
@endcomponent

A bientôt sur keeep.fr<br>

L'équeeep
@endcomponent
