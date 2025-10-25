@extends('layouts.admin')

@section('title', 'Ajouter un Membre - Orchestra Admin')

@section('page-title', 'Ajouter un Membre')

@section('styles')
<style>
    .form-container {
        max-width: 800px;
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

    .form-textarea {
        min-height: 120px;
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

    .file-input {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .file-input input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 20px;
        border: 2px dashed #d1d5db;
        border-radius: 10px;
        background: #f9fafb;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .file-input-label:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    .file-preview {
        margin-top: 15px;
        text-align: center;
    }

    .file-preview img {
        max-width: 200px;
        max-height: 150px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
    <a href="{{ route('admin.leadership.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Retour à la liste
    </a>

    <div class="form-card">
        <form action="{{ route('admin.leadership.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="name" class="form-label">Nom complet *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-input @error('name') error @enderror"
                        value="{{ old('name') }}"
                        required
                        placeholder="Ex: Jean Dupont"
                    >
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="position" class="form-label">Poste *</label>
                    <input
                        type="text"
                        id="position"
                        name="position"
                        class="form-input @error('position') error @enderror"
                        value="{{ old('position') }}"
                        required
                        placeholder="Ex: CEO, CTO, Directeur"
                    >
                    @error('position')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-input form-textarea @error('description') error @enderror"
                    placeholder="Description du membre de l'équipe..."
                >{{ old('description') }}</textarea>
                <div class="help-text">Description optionnelle du membre</div>
                @error('description')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Photo du membre *</label>
                <div class="file-input">
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        onchange="previewImage(this)"
                        required
                    >
                    <label for="image" class="file-input-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <div>
                            <div style="font-weight: 600; margin-bottom: 5px;">Cliquez pour sélectionner une photo</div>
                            <div style="font-size: 0.9rem; color: #64748b;">PNG, JPG, GIF jusqu'à 2MB</div>
                        </div>
                    </label>
                </div>
                <div id="image-preview" class="file-preview" style="display: none;">
                    <img id="preview-img" src="" alt="Aperçu">
                </div>
                @error('image')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="order" class="form-label">Ordre d'affichage</label>
                    <input
                        type="number"
                        id="order"
                        name="order"
                        class="form-input @error('order') error @enderror"
                        value="{{ old('order', 0) }}"
                        min="0"
                        placeholder="0"
                    >
                    <div class="help-text">Plus le nombre est petit, plus le membre apparaît en premier</div>
                    @error('order')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input
                            type="checkbox"
                            id="is_active"
                            name="is_active"
                            class="checkbox"
                            {{ old('is_active', true) ? 'checked' : '' }}
                        >
                        <label for="is_active" class="checkbox-label">
                            Activer ce membre
                        </label>
                    </div>
                    <div class="help-text">Les membres inactifs ne s'affichent pas sur le site</div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.leadership.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Créer le membre
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }

    // Animation du formulaire
    document.addEventListener('DOMContentLoaded', function() {
        const formCard = document.querySelector('.form-card');
        formCard.style.opacity = '0';
        formCard.style.transform = 'translateY(20px)';

        setTimeout(() => {
            formCard.style.transition = 'all 0.6s ease';
            formCard.style.opacity = '1';
            formCard.style.transform = 'translateY(0)';
        }, 100);
    });
</script>
@endsection
