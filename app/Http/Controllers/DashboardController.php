<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Afficher le tableau de bord
    public function index()
    {
        // Vous pouvez passer des données à la vue si nécessaire
        return view('dashboard.index');
    }
}
