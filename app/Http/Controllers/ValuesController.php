<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Value;

class ValuesController extends Controller
{
    /**
     * Affiche la page Our Values
     */
    public function index()
    {
        // Récupérer les valeurs depuis la base de données
        $valuesData = Value::where('is_active', true)->orderBy('order')->get();

        return view('values', compact('valuesData'));
    }
}
