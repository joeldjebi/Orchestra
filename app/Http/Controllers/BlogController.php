<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogArticle;

class BlogController extends Controller
{
    /**
     * Affiche la page Blog/Press
     */
    public function index()
    {
        // Récupérer les articles de blog depuis la base de données
        $blogData = BlogArticle::active()->ordered()->get();

        return view('blog', compact('blogData'));
    }
}
