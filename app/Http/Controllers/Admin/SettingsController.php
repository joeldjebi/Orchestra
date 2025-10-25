<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{
    /**
     * Affiche la page des paramètres
     */
    public function index()
    {
        $settings = [
            'site_name' => config('app.name', 'Orchestra'),
            'site_url' => config('app.url', 'http://localhost:8000'),
            'site_description' => 'Leading digital transformation agency in Africa',
            'contact_email' => 'contact@orchestra.com',
            'contact_phone' => '+225 20 30 40 50',
            'social_facebook' => 'https://facebook.com/orchestra',
            'social_twitter' => 'https://twitter.com/orchestra',
            'social_linkedin' => 'https://linkedin.com/company/orchestra',
            'maintenance_mode' => false,
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Met à jour les paramètres
     */
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_url' => 'required|url',
            'site_description' => 'required|string|max:500',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'social_facebook' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'maintenance_mode' => 'boolean',
        ]);

        // Ici, vous pourriez sauvegarder dans une table settings ou un fichier de config
        // Pour l'exemple, on simule la sauvegarde

        $settings = [
            'site_name' => $request->site_name,
            'site_url' => $request->site_url,
            'site_description' => $request->site_description,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'social_facebook' => $request->social_facebook,
            'social_twitter' => $request->social_twitter,
            'social_linkedin' => $request->social_linkedin,
            'maintenance_mode' => $request->boolean('maintenance_mode'),
        ];

        // Vider le cache pour appliquer les changements
        Cache::flush();
        Artisan::call('config:clear');
        Artisan::call('view:clear');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres mis à jour avec succès !');
    }

    /**
     * Actions système
     */
    public function systemAction(Request $request)
    {
        $action = $request->input('action');

        switch ($action) {
            case 'clear_cache':
                Artisan::call('cache:clear');
                Artisan::call('config:clear');
                Artisan::call('view:clear');
                $message = 'Cache vidé avec succès !';
                break;

            case 'optimize':
                Artisan::call('config:cache');
                Artisan::call('route:cache');
                Artisan::call('view:cache');
                $message = 'Application optimisée avec succès !';
                break;

            case 'migrate':
                Artisan::call('migrate', ['--force' => true]);
                $message = 'Migrations exécutées avec succès !';
                break;

            default:
                return redirect()->route('admin.settings.index')
                    ->with('error', 'Action non reconnue !');
        }

        return redirect()->route('admin.settings.index')
            ->with('success', $message);
    }
}
