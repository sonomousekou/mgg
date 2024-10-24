<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    /**
     * Display a listing of the equipements.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipements = Equipement::all();
        return response()->json($equipements);
    }

    /**
     * Store a newly created equipement in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'date_installation' => 'nullable|date',
            'site_id' => 'required|exists:sites,id',
            'etat' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $equipement = Equipement::create($request->all());

        return response()->json($equipement, 201);
    }

    /**
     * Display the specified equipement.
     *
     * @param  \App\Models\Equipement  $equipement
     * @return \Illuminate\Http\Response
     */
    public function show(Equipement $equipement)
    {
        return response()->json($equipement);
    }

    /**
     * Update the specified equipement in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipement  $equipement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipement $equipement)
    {
        $request->validate([
            'nom' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'date_installation' => 'nullable|date',
            'site_id' => 'required|exists:sites,id',
            'etat' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $equipement->update($request->all());

        return response()->json($equipement);
    }

    /**
     * Remove the specified equipement from storage.
     *
     * @param  \App\Models\Equipement  $equipement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipement $equipement)
    {
        $equipement->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $equipements = Equipement::where('nom', 'like', '%' . $request->q . '%')
            ->orWhere('model', 'like', '%' . $request->q . '%')
            ->orWhere('code', 'like', '%' . $request->q . '%')
            ->orWhere('etat', 'like', '%' . $request->q . '%')
            ->orWhere('description', 'like', '%' . $request->q . '%')
            ->get();
            
        if ($equipements->isEmpty()) {
            return response()->json(['message' => 'Aucun équipement trouvé'], 404);
        }
        return response()->json($equipements);
    }
}
