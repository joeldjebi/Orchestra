<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Affiche la liste des articles de blog
     */
    public function index()
    {
        $articles = BlogArticle::ordered()->get();
        return view('admin.blog.index', compact('articles'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Stocke un nouvel article
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'headline' => 'required|string|max:500',
            'content' => 'required|array',
            'content.paragraph1' => 'required|string',
            'content.paragraph2' => 'required|string',
            'content.paragraph3' => 'required|string',
            'content.paragraph4' => 'required|string',
            'content.paragraph5' => 'required|string',
            'sidebar_title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'layout' => 'required|in:left,right',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'headline' => $request->headline,
            'content' => $request->content,
            'sidebar_title' => $request->sidebar_title,
            'layout' => $request->layout,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        // Traitement de l'image si fournie
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // S'assurer que le dossier existe
            $blogDir = public_path('images/blog');
            if (!File::exists($blogDir)) {
                File::makeDirectory($blogDir, 0755, true);
            }

            $image->move($blogDir, $imageName);
            $data['image'] = 'images/blog/' . $imageName;
        }

        BlogArticle::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Article créé avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(BlogArticle $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Met à jour un article
     */
    public function update(Request $request, BlogArticle $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'headline' => 'required|string|max:500',
            'content' => 'required|array',
            'content.paragraph1' => 'required|string',
            'content.paragraph2' => 'required|string',
            'content.paragraph3' => 'required|string',
            'content.paragraph4' => 'required|string',
            'content.paragraph5' => 'required|string',
            'sidebar_title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'layout' => 'required|in:left,right',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'headline' => $request->headline,
            'content' => $request->content,
            'sidebar_title' => $request->sidebar_title,
            'layout' => $request->layout,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        // Traitement de la nouvelle image si fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($blog->image && File::exists(public_path($blog->image))) {
                File::delete(public_path($blog->image));
            }

            // Enregistrer la nouvelle image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // S'assurer que le dossier existe
            $blogDir = public_path('images/blog');
            if (!File::exists($blogDir)) {
                File::makeDirectory($blogDir, 0755, true);
            }

            $image->move($blogDir, $imageName);
            $data['image'] = 'images/blog/' . $imageName;
        }

        $blog->update($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Article mis à jour avec succès !');
    }

    /**
     * Supprime un article
     */
    public function destroy(BlogArticle $blog)
    {
        // Supprimer l'image associée
        if ($blog->image && File::exists(public_path($blog->image))) {
            File::delete(public_path($blog->image));
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Article supprimé avec succès !');
    }

    /**
     * Active/désactive un article
     */
    public function toggle(BlogArticle $blog)
    {
        $blog->update(['is_active' => !$blog->is_active]);

        $status = $blog->is_active ? 'activé' : 'désactivé';
        return redirect()->route('admin.blog.index')
            ->with('success', "Article {$status} avec succès !");
    }
}
