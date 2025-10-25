<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;

class AgenciesController extends Controller
{
    /**
     * Affiche la page Our Agencies
     */
    public function index()
    {
        // Récupérer les agences depuis la base de données
        $agenciesData = Agency::active()->ordered()->get();

        return view('agencies', compact('agenciesData'));
    }
}
