<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AgencyController extends Controller
{
    /**
     * Affiche la liste des agences
     */
    public function index()
    {
        $agencies = Agency::ordered()->get();
        return view('admin.agency.index', compact('agencies'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.agency.create');
    }

    /**
     * Stocke une nouvelle agence
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'services' => 'required|array',
            'services.*' => 'required|string',
            'color' => 'required|string|max:7',
            'url' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'services' => $request->services,
            'color' => $request->color,
            'url' => $request->url,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        // Traitement de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // S'assurer que le dossier existe
            $agencyDir = public_path('images/agencies');
            if (!File::exists($agencyDir)) {
                File::makeDirectory($agencyDir, 0755, true);
            }

            $image->move($agencyDir, $imageName);
            $data['image'] = 'images/agencies/' . $imageName;
        }

        Agency::create($data);

        return redirect()->route('admin.agency.index')
            ->with('success', 'Agence créée avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Agency $agency)
    {
        return view('admin.agency.edit', compact('agency'));
    }

    /**
     * Met à jour une agence
     */
    public function update(Request $request, Agency $agency)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'services' => 'required|array',
            'services.*' => 'required|string',
            'color' => 'required|string|max:7',
            'url' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'services' => $request->services,
            'color' => $request->color,
            'url' => $request->url,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        // Traitement de la nouvelle image si fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($agency->image && File::exists(public_path($agency->image))) {
                File::delete(public_path($agency->image));
            }

            // Enregistrer la nouvelle image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // S'assurer que le dossier existe
            $agencyDir = public_path('images/agencies');
            if (!File::exists($agencyDir)) {
                File::makeDirectory($agencyDir, 0755, true);
            }

            $image->move($agencyDir, $imageName);
            $data['image'] = 'images/agencies/' . $imageName;
        }

        $agency->update($data);

        return redirect()->route('admin.agency.index')
            ->with('success', 'Agence mise à jour avec succès !');
    }

    /**
     * Supprime une agence
     */
    public function destroy(Agency $agency)
    {
        // Supprimer l'image associée
        if ($agency->image && File::exists(public_path($agency->image))) {
            File::delete(public_path($agency->image));
        }

        $agency->delete();

        return redirect()->route('admin.agency.index')
            ->with('success', 'Agence supprimée avec succès !');
    }

    /**
     * Active/désactive une agence
     */
    public function toggle(Agency $agency)
    {
        $agency->update(['is_active' => !$agency->is_active]);

        $status = $agency->is_active ? 'activée' : 'désactivée';
        return redirect()->route('admin.agency.index')
            ->with('success', "Agence {$status} avec succès !");
    }
}
