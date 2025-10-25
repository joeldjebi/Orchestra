<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CarouselSlide;
use App\Models\LeadershipMember;
use App\Models\ContactInfo;
use App\Models\BlogArticle;
use App\Models\Value;
use App\Models\WorkProject;
use App\Models\Agency;

class DashboardController extends Controller
{
    /**
     * Affiche le dashboard admin
     */
    public function index()
    {
        $user = Auth::user();

        // Statistiques pour le dashboard
        $stats = [
            // Utilisateurs
            'total_users' => User::count(),
            'admin_users' => User::where('is_admin', true)->count(),
            'regular_users' => User::where('is_admin', false)->count(),

            // Carousel
            'total_carousel' => CarouselSlide::count(),
            'active_carousel' => CarouselSlide::where('is_active', true)->count(),

            // Leadership
            'total_leadership' => LeadershipMember::count(),
            'active_leadership' => LeadershipMember::where('is_active', true)->count(),

            // Contact
            'total_contact' => ContactInfo::count(),
            'active_contact' => ContactInfo::where('is_active', true)->count(),

            // Blog
            'total_blog' => BlogArticle::count(),
            'active_blog' => BlogArticle::where('is_active', true)->count(),

            // Values
            'total_values' => Value::count(),
            'active_values' => Value::where('is_active', true)->count(),

            // Work Projects
            'total_work' => WorkProject::count(),
            'active_work' => WorkProject::where('is_active', true)->count(),

            // Agencies
            'total_agencies' => Agency::count(),
            'active_agencies' => Agency::where('is_active', true)->count(),
        ];

        return view('admin.dashboard', compact('user', 'stats'));
    }
}
