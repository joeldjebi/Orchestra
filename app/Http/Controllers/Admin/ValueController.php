<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Value;
use Illuminate\Http\Request;

class ValueController extends Controller
{
    /**
     * Affiche la liste des valeurs
     */
    public function index()
    {
        $values = Value::ordered()->get();
        return view('admin.value.index', compact('values'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.value.create');
    }

    /**
     * Stocke une nouvelle valeur
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:255',
            'details' => 'required|array',
            'details.*' => 'required|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        Value::create([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
            'details' => $request->details,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.value.index')
            ->with('success', 'Valeur créée avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Value $value)
    {
        return view('admin.value.edit', compact('value'));
    }

    /**
     * Met à jour une valeur
     */
    public function update(Request $request, Value $value)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'icon' => 'required|string|max:255',
            'details' => 'required|array|min:1',
            'details.*' => 'required|string|min:3',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ], [
            'title.required' => 'Le titre est obligatoire.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 10 caractères.',
            'icon.required' => 'L\'icône est obligatoire.',
            'icon.max' => 'L\'icône ne peut pas dépasser 255 caractères.',
            'details.required' => 'Au moins un détail est obligatoire.',
            'details.min' => 'Au moins un détail est obligatoire.',
            'details.*.required' => 'Chaque détail est obligatoire.',
            'details.*.min' => 'Chaque détail doit contenir au moins 3 caractères.',
            'order.integer' => 'L\'ordre doit être un nombre entier.',
            'order.min' => 'L\'ordre doit être supérieur ou égal à 0.',
        ]);

        $value->title = $request->title;
        $value->description = $request->description;
        $value->icon = $request->icon;
        $value->details = $request->details;
        $value->order = $request->order ?? 0;
        $value->is_active = $request->boolean('is_active');
        $value->save();

        return redirect()->route('admin.value.index')
            ->with('success', 'Valeur mise à jour avec succès !');
    }

    /**
     * Supprime une valeur
     */
    public function destroy(Value $value)
    {
        $value->delete();

        return redirect()->route('admin.value.index')
            ->with('success', 'Valeur supprimée avec succès !');
    }

    /**
     * Active/désactive une valeur
     */
    public function toggle(Value $value)
    {
        $value->update(['is_active' => !$value->is_active]);

        $status = $value->is_active ? 'activée' : 'désactivée';
        return redirect()->route('admin.value.index')
            ->with('success', "Valeur {$status} avec succès !");
    }
}
