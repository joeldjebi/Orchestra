<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarouselController extends Controller
{
    /**
     * Affiche la liste des slides du carousel
     */
    public function index()
    {
        $slides = CarouselSlide::ordered()->get();
        return view('admin.carousel.index', compact('slides'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.carousel.create');
    }

    /**
     * Stocke un nouveau slide
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'items' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt' => 'nullable|string|max:255',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Traitement de l'image - méthode simple
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();

        // S'assurer que le dossier existe
        $carouselDir = public_path('images/carousel');
        if (!File::exists($carouselDir)) {
            File::makeDirectory($carouselDir, 0755, true);
        }

        $image->move($carouselDir, $imageName);
        $imagePath = 'images/carousel/' . $imageName;

        // Conversion des items (string vers array)
        $items = array_filter(explode("\n", $request->items));

        CarouselSlide::create([
            'title' => $request->title,
            'items' => $items,
            'image' => $imagePath,
            'alt' => $request->alt,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Slide créé avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(CarouselSlide $carousel)
    {
        return view('admin.carousel.edit', compact('carousel'));
    }

    /**
     * Met à jour un slide
     */
    public function update(Request $request, CarouselSlide $carousel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'items' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt' => 'nullable|string|max:255',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'items' => array_filter(explode("\n", $request->items)),
            'alt' => $request->alt,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        // Traitement de la nouvelle image si fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($carousel->image && File::exists(public_path($carousel->image))) {
                File::delete(public_path($carousel->image));
            }

            // Enregistrer la nouvelle image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // S'assurer que le dossier existe
            $carouselDir = public_path('images/carousel');
            if (!File::exists($carouselDir)) {
                File::makeDirectory($carouselDir, 0755, true);
            }

            $image->move($carouselDir, $imageName);
            $data['image'] = 'images/carousel/' . $imageName;
        }

        $carousel->update($data);

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Slide mis à jour avec succès !');
    }

    /**
     * Supprime un slide
     */
    public function destroy(CarouselSlide $carousel)
    {
        // Supprimer l'image associée
        if ($carousel->image && File::exists(public_path($carousel->image))) {
            File::delete(public_path($carousel->image));
        }

        $carousel->delete();

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Slide supprimé avec succès !');
    }

    /**
     * Active/désactive un slide
     */
    public function toggle(CarouselSlide $carousel)
    {
        $carousel->update(['is_active' => !$carousel->is_active]);

        $status = $carousel->is_active ? 'activé' : 'désactivé';
        return redirect()->route('admin.carousel.index')
            ->with('success', "Slide {$status} avec succès !");
    }
}