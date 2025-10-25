<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WorkProjectController extends Controller
{
    /**
     * Affiche la liste des projets
     */
    public function index()
    {
        $projects = WorkProject::ordered()->get();
        return view('admin.work.index', compact('projects'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.work.create');
    }

    /**
     * Stocke un nouveau projet
     */
    public function store(Request $request)
    {
        $request->validate([
            'client' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'url' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'client' => $request->client,
            'description' => $request->description,
            'category' => $request->category,
            'url' => $request->url,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        // Traitement de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // S'assurer que le dossier existe
            $workDir = public_path('images/work');
            if (!File::exists($workDir)) {
                File::makeDirectory($workDir, 0755, true);
            }

            $image->move($workDir, $imageName);
            $data['image'] = 'images/work/' . $imageName;
        }

        WorkProject::create($data);

        return redirect()->route('admin.work.index')
            ->with('success', 'Projet créé avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(WorkProject $work)
    {
        return view('admin.work.edit', compact('work'));
    }

    /**
     * Met à jour un projet
     */
    public function update(Request $request, WorkProject $work)
    {
        $request->validate([
            'client' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'url' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'client' => $request->client,
            'description' => $request->description,
            'category' => $request->category,
            'url' => $request->url,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        // Traitement de la nouvelle image si fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($work->image && File::exists(public_path($work->image))) {
                File::delete(public_path($work->image));
            }

            // Enregistrer la nouvelle image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // S'assurer que le dossier existe
            $workDir = public_path('images/work');
            if (!File::exists($workDir)) {
                File::makeDirectory($workDir, 0755, true);
            }

            $image->move($workDir, $imageName);
            $data['image'] = 'images/work/' . $imageName;
        }

        $work->update($data);

        return redirect()->route('admin.work.index')
            ->with('success', 'Projet mis à jour avec succès !');
    }

    /**
     * Supprime un projet
     */
    public function destroy(WorkProject $work)
    {
        // Supprimer l'image associée
        if ($work->image && File::exists(public_path($work->image))) {
            File::delete(public_path($work->image));
        }

        $work->delete();

        return redirect()->route('admin.work.index')
            ->with('success', 'Projet supprimé avec succès !');
    }

    /**
     * Active/désactive un projet
     */
    public function toggle(WorkProject $work)
    {
        $work->update(['is_active' => !$work->is_active]);

        $status = $work->is_active ? 'activé' : 'désactivé';
        return redirect()->route('admin.work.index')
            ->with('success', "Projet {$status} avec succès !");
    }
}
