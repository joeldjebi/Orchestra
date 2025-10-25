<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarouselSlide;
use App\Models\LeadershipMember;
use App\Models\ContactInfo;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil avec le carousel
     */
    public function index()
    {
        // Récupérer les données du carousel depuis la base de données
        $carouselData = CarouselSlide::active()->ordered()->get();

        // Récupérer les données du leadership depuis la base de données
        $leadershipData = LeadershipMember::active()->ordered()->get();

        // Récupérer les données de contact depuis la base de données
        $contactData = ContactInfo::active()->first();

        return view('home', compact('carouselData', 'leadershipData', 'contactData'));
    }
}
