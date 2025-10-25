<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadershipMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LeadershipController extends Controller
{
    /**
     * Affiche la liste des membres du leadership
     */
    public function index()
    {
        $members = LeadershipMember::ordered()->get();
        return view('admin.leadership.index', compact('members'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.leadership.create');
    }

    /**
     * Stocke un nouveau membre
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Traitement de l'image - méthode simple
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();

        // S'assurer que le dossier existe
        $leadershipDir = public_path('images/leadership');
        if (!File::exists($leadershipDir)) {
            File::makeDirectory($leadershipDir, 0755, true);
        }

        $image->move($leadershipDir, $imageName);
        $imagePath = 'images/leadership/' . $imageName;

        LeadershipMember::create([
            'name' => $request->name,
            'position' => $request->position,
            'description' => $request->description,
            'image' => $imagePath,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.leadership.index')
            ->with('success', 'Membre du leadership créé avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(LeadershipMember $leadership)
    {
        return view('admin.leadership.edit', compact('leadership'));
    }

    /**
     * Met à jour un membre
     */
    public function update(Request $request, LeadershipMember $leadership)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        // Traitement de la nouvelle image si fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($leadership->image && File::exists(public_path($leadership->image))) {
                File::delete(public_path($leadership->image));
            }

            // Enregistrer la nouvelle image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // S'assurer que le dossier existe
            $leadershipDir = public_path('images/leadership');
            if (!File::exists($leadershipDir)) {
                File::makeDirectory($leadershipDir, 0755, true);
            }

            $image->move($leadershipDir, $imageName);
            $data['image'] = 'images/leadership/' . $imageName;
        }

        $leadership->update($data);

        return redirect()->route('admin.leadership.index')
            ->with('success', 'Membre du leadership mis à jour avec succès !');
    }

    /**
     * Supprime un membre
     */
    public function destroy(LeadershipMember $leadership)
    {
        // Supprimer l'image associée
        if ($leadership->image && File::exists(public_path($leadership->image))) {
            File::delete(public_path($leadership->image));
        }

        $leadership->delete();

        return redirect()->route('admin.leadership.index')
            ->with('success', 'Membre du leadership supprimé avec succès !');
    }

    /**
     * Active/désactive un membre
     */
    public function toggle(LeadershipMember $leadership)
    {
        $leadership->update(['is_active' => !$leadership->is_active]);

        $status = $leadership->is_active ? 'activé' : 'désactivé';
        return redirect()->route('admin.leadership.index')
            ->with('success', "Membre du leadership {$status} avec succès !");
    }
}
