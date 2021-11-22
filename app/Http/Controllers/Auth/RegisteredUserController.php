<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Int $id, String $token)
    {
        $student = User::where('register_token', $token)->find($id);

        if ($student !== null) {
            return view('auth.register', compact('student'));
        } else {
            dd('Token invalide, redirect ou msg erreur');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(User $user, Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'firstname' => ['required', 'string', 'min:2', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'numeric'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],
        [
            'name.required' => 'Vous devez indiquer votre nom',
            'name.min' => 'Votre nom doit faire :min caractères minimum',
            'name.max' => 'Votre nom ne peut exéder :max caractères',
            'name.string' => 'Votre nom doit être une chaine de caractères',
            'firstname.required' => 'Vous devez indiquer votre prénom',
            'firstname.min' => 'Votre prénom doit faire :min caractères minimum',
            'firstname.max' => 'Votre prénom ne peut exéder :max caractères',
            'firstname.string' => 'Votre prénom doit être une chaine de caractères',
            'address.max' => 'Votre adresse ne peut exéder :max caractères',
            'address.string' => 'Votre adresse doit être une chaine de caractères',
            'phone.numeric' => 'Votre numéro de téléphone ne peut comporter que des chiffres',
            'password.required' => 'Votre mot de passe est obligatoire',
            'password.confirmed' => 'Les mots de passes ne sont pas identique',
        ]);

        // Hash le password
        $data['password'] = Hash::make($data['password']);
        // Supression du token pour éviter des inscriptions a l'infini
        $data['register_token'] = NULL;

        // Est-ce qu'on fais un str replace pour le N° de tel pour replace les espace, point et tiret pour normé le N° de tel ?

        $user->update($data);

        $user = User::find($user->id);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Bravo ! Inscription terminée');
    }
}
