<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

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
            'name' => ['required', 'max:255'],
            'firstname' => ['required', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'school' => ['required', 'max:255']
        ]);

        // On met l'ecole en majuscule
        $data['school'] = strtoupper($data['school']);
        
        // On check que l'école n'existe pas deja
        // PLUSIEURS REFERENTS POUR UNE ECOLE ? Si oui : on cré le referent si l'ecole existe deja, sinon msg erreurs ?
        $school = School::where('name', $data['school'])->get();
        if ($school->isNotEmpty()) {
            dd($school);
        } else {
            dd('On doit créer l\'école');
        }

        // Envoie d'un mail au référent
        // Jobs ?
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
