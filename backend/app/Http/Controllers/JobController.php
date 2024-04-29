<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $jobs = Job::all();

        return response()->json($jobs, 200);
    }


    public function store(Request $request)
    {
        // Valider les données reçues du formulaire
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'email_confirmation' => 'required|email|same:email',
            'naissance' => 'required|date',
            'famille' => 'required|string|in:celibataire_sans_enfants,celibataire_avec_enfants,marie_sans_enfants,marie_avec_enfants',
            'telephone' => 'required|string',
            'adresse' => 'required|string',
        ]);

        // Créer une nouvelle instance de Job avec les données validées
        $job = new Job();
        $job->nom = $validatedData['nom'];
        $job->prenom = $validatedData['prenom'];
        $job->email = $validatedData['email'];
        $job->naissance = $validatedData['naissance'];
        $job->famille = $validatedData['famille'];
        $job->telephone = $validatedData['telephone'];
        $job->adresse = $validatedData['adresse'];

        $job->save();

        // Retourner une réponse JSON avec l'offre d'emploi enregistrée
        return response()->json(['message' => 'Offre d\'emploi enregistrée avec succès', 'job' => $job], 201);
    }

}
