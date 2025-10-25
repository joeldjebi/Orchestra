<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Affiche le formulaire d'inscription
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Traite l'inscription
     */
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false, // Par défaut, les nouveaux utilisateurs ne sont pas admin
        ]);

        Auth::login($user);

        return redirect('/admin/dashboard');
    }
}
