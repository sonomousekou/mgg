<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the agents.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::all();
        return response()->json($agents);
    }

    /**
     * Store a newly created agent in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:agents',
            'matricule' => 'nullable|string|max:255|unique:agents',
            'pin' => 'nullable|string|max:255|unique:agents',
            'user_id' => 'nullable|exists:users,id',
            'sexe' => 'nullable|string|max:255',
            'nationalite' => 'nullable|string|max:255',
            'civilite' => 'nullable|string|max:255',
            'lieu_naissance' => 'nullable|string|max:255',
            'dernier_diplome' => 'nullable|date',
            'date_embauche' => 'nullable|date',
            'photo' => 'nullable|string',
            'certifications' => 'nullable|string',
            'actif' => 'nullable|boolean',
            'date_naissance' => 'nullable|date',
            'telephone' => 'nullable|string',
            'adresse' => 'nullable|string',
            'poste_actuel' => 'nullable|string',

        ]);

        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $agent = Agent::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'user_id' => $user->id,
            'sexe' => $request->sexe,
            'nationalite' => $request->nationalite,
            'civilite' => $request->civilite,
            'lieu_naissance' => $request->lieu_naissance,
            'dernier_diplome' => $request->dernier_diplome,
            'matricule' => $request->matricule,
            'pin' => $request->pin,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'poste_actuel' => $request->poste_actuel,
            'date_embauche' => $request->date_embauche,
            'photo' => $request->photo,
            'certifications' => $request->certifications,
            'actif' => $request->actif,
            'date_naissance' => $request->date_naissance,

        ]);

        return response()->json($agent, 201);
    }

    /**
     * Display the specified agent.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        return response()->json($agent);
    }

    /**
     * Update the specified agent in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:agents,email,' . $agent->id,
            'matricule' => 'nullable|string|max:255|unique:agents,matricule,' . $agent->id,
            'pin' => 'nullable|string|max:255|unique:agents,pin,' . $agent->id,
            'user_id' => 'nullable|exists:users,id',
            'sexe' => 'nullable|string|max:255',
            'nationalite' => 'nullable|string|max:255',
            'civilite' => 'nullable|string|max:255',
            'lieu_naissance' => 'nullable|string|max:255',
            'dernier_diplome' => 'nullable|date',
            'photo' => 'nullable|string',
            'certifications' => 'nullable|string',
            'actif' => 'nullable|boolean',
            'date_embauche' => 'nullable|date',
            'adresse' => 'nullable|string',
            'poste_actuel' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|string|email|max:255|unique:agents,email,' . $agent->id,

        ]);

        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $agent->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'user_id' => $user->id,
            'sexe' => $request->sexe,
            'nationalite' => $request->nationalite,
            'civilite' => $request->civilite,
            'lieu_naissance' => $request->lieu_naissance,
            'dernier_diplome' => $request->dernier_diplome,
            'photo' => $request->photo,
            'certifications' => $request->certifications,
            'matricule' => $request->matricule,
            'pin' => $request->pin,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'poste_actuel' => $request->poste_actuel,
            'date_embauche' => $request->date_embauche,
            'actif' => $request->actif,
            'date_naissance' => $request->date_naissance,

        ]);

        return response()->json($agent);
    }

    /**
     * Remove the specified agent from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        $agent->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $agents = Agent::where('nom', 'like', '%' . $request->q . '%')
            ->orWhere('prenom', 'like', '%' . $request->q . '%')
            ->orWhere('matricule', 'like', '%' . $request->q . '%')
            ->orWhere('email', 'like', '%' . $request->q . '%')
            ->orWhere('telephone', 'like', '%' . $request->q . '%')
            ->orWhere('poste_actuel', 'like', '%' . $request->q . '%')
            ->orWhere('date_embauche', 'like', '%' . $request->q . '%')
            ->orWhere('date_naissance', 'like', '%' . $request->q . '%')
            ->orWhere('dernier_diplome', 'like', '%' . $request->q . '%')
            ->orWhere('certifications', 'like', '%' . $request->q . '%')
            ->orWhere('actif', 'like', '%' . $request->q . '%')
            ->orWhere('user_id', 'like', '%' . $request->q . '%')
            ->get();
        return response()->json($agents);
    }
}
