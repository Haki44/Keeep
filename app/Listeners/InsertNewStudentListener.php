<?php

namespace App\Listeners;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use App\Events\AddStudentEvent;
use App\Mail\RegisterStudentMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        $data['email'] = $event->student['email'];
        $data['role_id'] = Role::where('name', 'STUDENT')->first()->id;
        $data['school_id'] = auth()->user()->school->id;
        $data['register_token'] = Str::uuid()->toString();

        $student = User::create($data);

        // // Envoie du mail a l'etudiant
        Mail::to($student->email)->send(new RegisterStudentMail($student));
    }
}
