<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ContactController extends Controller
{
    /**
     * Affiche la liste des informations de contact
     */
    public function index()
    {
        $contacts = ContactInfo::all();
        return view('admin.contact.index', compact('contacts'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.contact.create');
    }

    /**
     * Stocke de nouvelles informations de contact
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'office_hours' => 'required|array',
            'office_hours.*' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'office_hours' => $request->office_hours,
            'is_active' => $request->has('is_active'),
        ];

        // Traitement de l'image si fournie
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // S'assurer que le dossier existe
            $contactDir = public_path('images/contact');
            if (!File::exists($contactDir)) {
                File::makeDirectory($contactDir, 0755, true);
            }

            $image->move($contactDir, $imageName);
            $data['image'] = 'images/contact/' . $imageName;
        }

        ContactInfo::create($data);

        return redirect()->route('admin.contact.index')
            ->with('success', 'Informations de contact créées avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(ContactInfo $contact)
    {
        return view('admin.contact.edit', compact('contact'));
    }

    /**
     * Met à jour les informations de contact
     */
    public function update(Request $request, ContactInfo $contact)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'office_hours' => 'required|array',
            'office_hours.*' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'office_hours' => $request->office_hours,
            'is_active' => $request->has('is_active'),
        ];

        // Traitement de la nouvelle image si fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($contact->image && File::exists(public_path($contact->image))) {
                File::delete(public_path($contact->image));
            }

            // Enregistrer la nouvelle image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // S'assurer que le dossier existe
            $contactDir = public_path('images/contact');
            if (!File::exists($contactDir)) {
                File::makeDirectory($contactDir, 0755, true);
            }

            $image->move($contactDir, $imageName);
            $data['image'] = 'images/contact/' . $imageName;
        }

        $contact->update($data);

        return redirect()->route('admin.contact.index')
            ->with('success', 'Informations de contact mises à jour avec succès !');
    }

    /**
     * Supprime les informations de contact
     */
    public function destroy(ContactInfo $contact)
    {
        // Supprimer l'image associée
        if ($contact->image && File::exists(public_path($contact->image))) {
            File::delete(public_path($contact->image));
        }

        $contact->delete();

        return redirect()->route('admin.contact.index')
            ->with('success', 'Informations de contact supprimées avec succès !');
    }

    /**
     * Active/désactive les informations de contact
     */
    public function toggle(ContactInfo $contact)
    {
        $contact->update(['is_active' => !$contact->is_active]);

        $status = $contact->is_active ? 'activées' : 'désactivées';
        return redirect()->route('admin.contact.index')
            ->with('success', "Informations de contact {$status} avec succès !");
    }
}
