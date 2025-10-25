@extends('layouts.admin')

@section('title', 'Modifier l\'Utilisateur - Orchestra Admin')

@section('page-title', 'Modifier l\'Utilisateur')

@section('styles')
<style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .form-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
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

    .help-text {
        font-size: 0.85rem;
        color: #64748b;
        margin-top: 5px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 20px;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .password-section {
        background: #f8fafc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .password-section h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
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
<div class="form-container">
    <a href="{{ route('admin.users.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Retour à la liste
    </a>

    <div class="form-card">
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

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="nom" class="form-label">Nom *</label>
                    <input
                        type="text"
                        id="nom"
                        name="nom"
                        class="form-input @error('nom') error @enderror"
                        value="{{ old('nom', $user->nom) }}"
                        required
                        placeholder="Ex: Dupont"
                    >
                    @error('nom')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="prenoms" class="form-label">Prénoms *</label>
                    <input
                        type="text"
                        id="prenoms"
                        name="prenoms"
                        class="form-input @error('prenoms') error @enderror"
                        value="{{ old('prenoms', $user->prenoms) }}"
                        required
                        placeholder="Ex: Jean Pierre"
                    >
                    @error('prenoms')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email *</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input @error('email') error @enderror"
                    value="{{ old('email', $user->email) }}"
                    required
                    placeholder="Ex: jean.dupont@exemple.com"
                >
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="password-section">
                <h3>Changer le mot de passe</h3>
                <p style="color: #64748b; margin-bottom: 15px; font-size: 0.9rem;">Laissez vide pour conserver le mot de passe actuel</p>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">Nouveau mot de passe</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input @error('password') error @enderror"
                            placeholder="Minimum 8 caractères"
                        >
                        @error('password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-input @error('password_confirmation') error @enderror"
                            placeholder="Répétez le nouveau mot de passe"
                        >
                        @error('password_confirmation')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input
                        type="hidden"
                        name="is_admin"
                        value="0"
                    >
                    <input
                        type="checkbox"
                        id="is_admin"
                        name="is_admin"
                        value="1"
                        class="checkbox"
                        {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                    >
                    <label for="is_admin" class="checkbox-label">
                        Accorder les droits d'administrateur
                    </label>
                </div>
                <div class="help-text">Les administrateurs ont accès à toutes les fonctionnalités</div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
