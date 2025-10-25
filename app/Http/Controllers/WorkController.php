<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkProject;

class WorkController extends Controller
{
    /**
     * Affiche la page Work avec les projets clients
     */
    public function index()
    {
        // Récupérer les projets depuis la base de données
        $workData = WorkProject::active()->ordered()->get();

        return view('work', compact('workData'));
    }
}
