<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Stocke un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->boolean('is_admin'),
        ]);

        return redirect()->route('admin.userss.index')
            ->with('success', 'Utilisateur créé avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Met à jour un utilisateur
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'boolean',
        ]);

        $data = [
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'is_admin' => $request->boolean('is_admin'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur mis à jour avec succès !');
    }

    /**
     * Supprime un utilisateur
     */
    public function destroy(User $user)
    {
        // Empêcher la suppression de l'utilisateur connecté
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte !');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur supprimé avec succès !');
    }

    /**
     * Active/désactive un utilisateur
     */
    public function toggle(User $user)
    {
        // Empêcher la désactivation de l'utilisateur connecté
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas désactiver votre propre compte !');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'activé' : 'désactivé';
        return redirect()->route('admin.users.index')
            ->with('success', "Utilisateur {$status} avec succès !");
    }
}
