<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\AddReferentEvent;
use App\Providers\RouteServiceProvider;

class ReferentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('referent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'school' => ['required', 'max:255', 'string']
        ],
        [
            'email.required' => 'Vous devez indiquer une adresse email',
            'email.string' => 'L\'adresse email doit être une chaine de caractère',
            'email.email' => 'L\'adresse email doit être une adresse email valide',
            'email.max' => 'L\'adresse email ne peut exéder :max caractères',
            'email.unique' => 'L\'adresse email existe déjà',
            'school.required' => 'Vous devez indiquer une école',
            'school.max' => 'L\'école ne peut exéder :max caractères',
            'school.string' => 'L\'école doit être une chaine de caractère',
        ]);

        // On appel l'event d'ajout de referent
        event(new AddReferentEvent($data));

        // Redirection vers une page indiquant qu'un mail vient d'etre envoyé
        return redirect(RouteServiceProvider::HOME)->with('success', 'Le référent a bien été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
