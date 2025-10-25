<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AgenciesController;
use App\Http\Controllers\ValuesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\LeadershipController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ValueController;
use App\Http\Controllers\Admin\WorkProjectController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingsController;

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/work', [WorkController::class, 'index'])->name('work');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/agencies', [AgenciesController::class, 'index'])->name('agencies');
Route::get('/values', [ValuesController::class, 'index'])->name('values');

// Routes d'authentification
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Routes admin (protégées)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes pour la gestion du carousel
    Route::resource('carousel', CarouselController::class);
    Route::post('/carousel/{carousel}/toggle', [CarouselController::class, 'toggle'])->name('carousel.toggle');

    // Routes pour la gestion du leadership
    Route::resource('leadership', LeadershipController::class);
    Route::post('/leadership/{leadership}/toggle', [LeadershipController::class, 'toggle'])->name('leadership.toggle');

    // Routes pour la gestion des contacts
    Route::resource('contact', ContactController::class);
    Route::post('/contact/{contact}/toggle', [ContactController::class, 'toggle'])->name('contact.toggle');

            // Routes pour la gestion des articles de blog
            Route::resource('blog', AdminBlogController::class);
            Route::post('/blog/{blog}/toggle', [AdminBlogController::class, 'toggle'])->name('blog.toggle');

            // Routes pour la gestion des valeurs
            Route::resource('value', ValueController::class);
            Route::post('/value/{value}/toggle', [ValueController::class, 'toggle'])->name('value.toggle');

            // Routes pour la gestion des projets
            Route::resource('work', WorkProjectController::class);
            Route::post('/work/{work}/toggle', [WorkProjectController::class, 'toggle'])->name('work.toggle');

            // Routes pour la gestion des agences
            Route::resource('agency', AgencyController::class);
            Route::post('/agency/{agency}/toggle', [AgencyController::class, 'toggle'])->name('agency.toggle');

            // Routes pour la gestion des utilisateurs
            Route::resource('users', UserController::class);
            Route::post('/users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');

            // Routes pour les paramètres
            Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
            Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
            Route::post('/settings/system', [SettingsController::class, 'systemAction'])->name('settings.system');
});
