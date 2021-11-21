<?php

namespace App\Listeners;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use App\Events\AddStudentEvent;
use App\Jobs\SendInviteStudentJob;

class InsertNewStudentListener
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
     * @param  AddStudentEvent  $event
     * @return void
     */
    public function handle(AddStudentEvent $event)
    {
        $data = [
            'email' => $event->student['email'],
            'role_id' => Role::where('name', 'STUDENT')->first()->id,
            // Vu que c'est un référent qui ajoute un élève on peux récupérer l'id de l'école
            'school_id' => auth()->user()->school->id,
            'register_token' => Str::uuid()->toString()
        ];

        // Création de l'élève en DB
        $student = User::create($data);

        // Création d'un Job pour envoie de mail à l'élève
        SendInviteStudentJob::dispatch($student);
    }
}
