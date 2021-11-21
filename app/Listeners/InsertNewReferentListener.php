<?php

namespace App\Listeners;

use App\Models\Role;
use App\Models\User;
use App\Models\School;
use Illuminate\Support\Str;
use App\Events\AddReferentEvent;
use App\Jobs\SendInviteReferentJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InsertNewReferentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddReferentEvent  $event
     * @return void
     */
    public function handle(AddReferentEvent $event)
    {
        // On met l'ecole en majuscule
        $data['school'] = strtoupper($event->referent['school']);
        
        // On check que l'école n'existe pas deja
        // PLUSIEURS REFERENTS POUR UNE ECOLE ? Si oui : on cré le referent si l'ecole existe deja, sinon msg erreurs ?
        $school = School::where('name', $data['school'])->get();
        if ($school->isNotEmpty()) {
            dd('Déjà un référent pour cette école');
        } else {
            // Création de l'école
            $school = School::create([
                'name' => $data['school']
            ]);
        }

        // Supprime l'école de data
        unset($data['school']);

        // Ajout de l'id de l'école du referent + email + role_id + token
        $data['school_id'] = $school->id;
        $data['email'] = $event->referent['email'];
        $data['role_id'] = Role::where('name', 'REFERENT')->first()->id;
        $data['register_token'] = Str::uuid()->toString();

        // Création du referent en DB
        $referent = User::create($data);

        // Création d'un Job pour envoie de mail au referent
        SendInviteReferentJob::dispatch($referent);
    }
}
