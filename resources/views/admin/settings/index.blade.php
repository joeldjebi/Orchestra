@extends('layouts.admin')

@section('title', 'Paramètres - Orchestra Admin')

@section('page-title', 'Paramètres du Site')

@section('styles')
<style>
    .settings-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .settings-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .settings-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    .settings-card h3 {
        font-size: 1.3rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f9fafb;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        background: white;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }

    .form-error {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox {
        width: 18px;
        height: 18px;
        accent-color: #3b82f6;
    }

    .checkbox-label {
        font-weight: 500;
        color: #374151;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1e3a8a);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .help-text {
        font-size: 0.85rem;
        color: #64748b;
        margin-top: 5px;
    }

    .system-actions {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .system-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }

    .system-action-info h4 {
        font-size: 1rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 5px 0;
    }

    .system-action-info p {
        font-size: 0.85rem;
        color: #64748b;
        margin: 0;
    }

    .system-stats {
        background: #f8fafc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .stat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .stat-item:last-child {
        border-bottom: none;
    }

    .stat-label {
        font-weight: 500;
        color: #374151;
    }

    .stat-value {
        font-weight: 600;
        color: #1e293b;
    }

    @media (max-width: 768px) {
        .settings-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="settings-container">
    @if(session('success'))
        <div class="alert alert-success" style="background: #d1fae5; border: 1px solid #a7f3d0; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" style="background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="settings-grid">
        <!-- Paramètres du site -->
        <div class="settings-card">
            <h3>
                <i class="fas fa-cog"></i>
                Paramètres du Site
            </h3>

            @if ($errors->any())
                <div class="alert alert-danger" style="background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <h4 style="margin: 0 0 10px 0; font-size: 1.1rem;">Erreurs de validation :</h4>
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="site_name" class="form-label">Nom du site *</label>
                    <input
                        type="text"
                        id="site_name"
                        name="site_name"
                        class="form-input @error('site_name') error @enderror"
                        value="{{ old('site_name', $settings['site_name']) }}"
                        required
                        placeholder="Ex: Orchestra"
                    >
                    @error('site_name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="site_url" class="form-label">URL du site *</label>
                    <input
                        type="url"
                        id="site_url"
                        name="site_url"
                        class="form-input @error('site_url') error @enderror"
                        value="{{ old('site_url', $settings['site_url']) }}"
                        required
                        placeholder="https://orchestra.com"
                    >
                    @error('site_url')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="site_description" class="form-label">Description du site *</label>
                    <textarea
                        id="site_description"
                        name="site_description"
                        class="form-input form-textarea @error('site_description') error @enderror"
                        required
                        placeholder="Description du site..."
                    >{{ old('site_description', $settings['site_description']) }}</textarea>
                    @error('site_description')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="contact_email" class="form-label">Email de contact *</label>
                        <input
                            type="email"
                            id="contact_email"
                            name="contact_email"
                            class="form-input @error('contact_email') error @enderror"
                            value="{{ old('contact_email', $settings['contact_email']) }}"
                            required
                            placeholder="contact@orchestra.com"
                        >
                        @error('contact_email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_phone" class="form-label">Téléphone *</label>
                        <input
                            type="text"
                            id="contact_phone"
                            name="contact_phone"
                            class="form-input @error('contact_phone') error @enderror"
                            value="{{ old('contact_phone', $settings['contact_phone']) }}"
                            required
                            placeholder="+225 20 30 40 50"
                        >
                        @error('contact_phone')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h4 style="margin: 30px 0 15px 0; color: #1e293b;">Réseaux sociaux</h4>

                <div class="form-group">
                    <label for="social_facebook" class="form-label">Facebook</label>
                    <input
                        type="url"
                        id="social_facebook"
                        name="social_facebook"
                        class="form-input @error('social_facebook') error @enderror"
                        value="{{ old('social_facebook', $settings['social_facebook']) }}"
                        placeholder="https://facebook.com/orchestra"
                    >
                    @error('social_facebook')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="social_twitter" class="form-label">Twitter</label>
                    <input
                        type="url"
                        id="social_twitter"
                        name="social_twitter"
                        class="form-input @error('social_twitter') error @enderror"
                        value="{{ old('social_twitter', $settings['social_twitter']) }}"
                        placeholder="https://twitter.com/orchestra"
                    >
                    @error('social_twitter')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="social_linkedin" class="form-label">LinkedIn</label>
                    <input
                        type="url"
                        id="social_linkedin"
                        name="social_linkedin"
                        class="form-input @error('social_linkedin') error @enderror"
                        value="{{ old('social_linkedin', $settings['social_linkedin']) }}"
                        placeholder="https://linkedin.com/company/orchestra"
                    >
                    @error('social_linkedin')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input
                            type="hidden"
                            name="maintenance_mode"
                            value="0"
                        >
                        <input
                            type="checkbox"
                            id="maintenance_mode"
                            name="maintenance_mode"
                            value="1"
                            class="checkbox"
                            {{ old('maintenance_mode', $settings['maintenance_mode']) ? 'checked' : '' }}
                        >
                        <label for="maintenance_mode" class="checkbox-label">
                            Mode maintenance
                        </label>
                    </div>
                    <div class="help-text">Active le mode maintenance pour le site</div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Sauvegarder les paramètres
                    </button>
                </div>
            </form>
        </div>

        <!-- Actions système -->
        <div class="settings-card">
            <h3>
                <i class="fas fa-tools"></i>
                Actions Système
            </h3>

            <div class="system-stats">
                <h4 style="margin: 0 0 15px 0; color: #1e293b;">Statistiques</h4>
                <div class="stat-item">
                    <span class="stat-label">Version Laravel</span>
                    <span class="stat-value">{{ app()->version() }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Environnement</span>
                    <span class="stat-value">{{ app()->environment() }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Debug</span>
                    <span class="stat-value">{{ config('app.debug') ? 'Activé' : 'Désactivé' }}</span>
                </div>
            </div>

            <div class="system-actions">
                <form action="{{ route('admin.settings.system') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="action" value="clear_cache">
                    <div class="system-action">
                        <div class="system-action-info">
                            <h4>Vider le cache</h4>
                            <p>Supprime tous les fichiers de cache</p>
                        </div>
                        <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-trash"></i>
                            Vider
                        </button>
                    </div>
                </form>

                <form action="{{ route('admin.settings.system') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="action" value="optimize">
                    <div class="system-action">
                        <div class="system-action-info">
                            <h4>Optimiser l'application</h4>
                            <p>Cache la configuration et les routes</p>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-rocket"></i>
                            Optimiser
                        </button>
                    </div>
                </form>

                <form action="{{ route('admin.settings.system') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="action" value="migrate">
                    <div class="system-action">
                        <div class="system-action-info">
                            <h4>Exécuter les migrations</h4>
                            <p>Applique les migrations en attente</p>
                        </div>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-database"></i>
                            Migrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
