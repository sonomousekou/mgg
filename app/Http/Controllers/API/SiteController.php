<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;

class SiteController extends Controller
{
    // Affiche une liste de tous les sites
    public function index()
    {
        return Site::all();
    }

    // Stocke un nouveau site
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'responsable_nom' => 'required|string|max:255',
            'responsable_contact' => 'required|string|max:255',
            'responsable_email' => 'required|string|max:255',
            'type_site' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'consignes_specifiques' => 'nullable|string',
            'photo' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $site = Site::create($validatedData);

        return response()->json($site, 201);
    }

    // Affiche un site spécifique
    public function show($id)
    {
        return Site::findOrFail($id);
    }

    // Met à jour un site existant
    public function update(Request $request, $id)
    {
        $site = Site::findOrFail($id);

        $validatedData = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|max:255',
            'adresse' => 'sometimes|required|string|max:255',
            'responsable_nom' => 'sometimes|required|string|max:255',
            'responsable_contact' => 'sometimes|required|string|max:255',
            'responsable_email' => 'sometimes|required|string|max:255',
            'type_site' => 'sometimes|required|string|max:255',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
        ]);

        $site->update($validatedData);

        return response()->json($site, 200);
    }

    // Supprime un site
    public function destroy($id)
    {
        $site = Site::findOrFail($id);
        $site->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $query = Site::query();
        if ($request->has('nom')) {
            $query->where('nom', 'like', '%' . $request->nom . '%');
        }

        if ($request->has('code')) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }

        if ($request->has('adresse')) {
            $query->where('adresse', 'like', '%' . $request->adresse . '%');
        }

        if ($request->has('responsable_nom')) {
            $query->where('responsable_nom', 'like', '%' . $request->responsable_nom . '%');
        }

        return $query->get();
        
    }

}
