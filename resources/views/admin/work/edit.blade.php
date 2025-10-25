@extends('layouts.admin')

@section('title', 'Modifier le Projet - Orchestra Admin')

@section('page-title', 'Modifier le Projet')

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

    .current-image {
        margin-bottom: 15px;
        text-align: center;
    }

    .current-image img {
        max-width: 200px;
        max-height: 150px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .file-input {
        position: relative;
        display: inline-block;
        cursor: pointer;
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
        display: block;
        padding: 12px 16px;
        border: 2px dashed #d1d5db;
        border-radius: 10px;
        text-align: center;
        background: #f9fafb;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .file-input:hover .file-input-label {
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
    <a href="{{ route('admin.work.index') }}" class="back-link">
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

        <form action="{{ route('admin.work.update', $work) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="client" class="form-label">Client *</label>
                    <input
                        type="text"
                        id="client"
                        name="client"
                        class="form-input @error('client') error @enderror"
                        value="{{ old('client', $work->client) }}"
                        required
                        placeholder="Ex: Microsoft"
                    >
                    @error('client')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category" class="form-label">Catégorie</label>
                    <input
                        type="text"
                        id="category"
                        name="category"
                        class="form-input @error('category') error @enderror"
                        value="{{ old('category', $work->category) }}"
                        placeholder="Ex: Web Development"
                    >
                    @error('category')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Image</label>

                @if($work->image)
                <div class="current-image">
                    <p style="margin-bottom: 10px; color: #64748b; font-size: 0.9rem;">Image actuelle :</p>
                    <img src="{{ asset($work->image) }}" alt="{{ $work->client }}">
                </div>
                @endif

                <div class="file-input">
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    <label for="image" class="file-input-label">
                        <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; margin-bottom: 10px; color: #6b7280;"></i>
                        <div>{{ $work->image ? 'Cliquez pour changer l\'image' : 'Cliquez pour sélectionner une image' }}</div>
                        <div style="font-size: 0.8rem; color: #9ca3af; margin-top: 5px;">PNG, JPG, GIF jusqu'à 2MB</div>
                    </label>
                </div>
                <div id="image-preview" class="file-preview" style="display: none;">
                    <img id="preview-img" src="" alt="Aperçu">
                </div>
                @error('image')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-input form-textarea @error('description') error @enderror"
                    placeholder="Description du projet..."
                >{{ old('description', $work->description) }}</textarea>
                @error('description')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="url" class="form-label">URL du projet</label>
                <input
                    type="url"
                    id="url"
                    name="url"
                    class="form-input @error('url') error @enderror"
                    value="{{ old('url', $work->url) }}"
                    placeholder="https://exemple.com"
                >
                @error('url')
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
                        value="{{ old('order', $work->order) }}"
                        min="0"
                        placeholder="0"
                    >
                    <div class="help-text">Plus le nombre est petit, plus le projet apparaît en premier</div>
                    @error('order')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input
                            type="hidden"
                            name="is_active"
                            value="0"
                        >
                        <input
                            type="checkbox"
                            id="is_active"
                            name="is_active"
                            value="1"
                            class="checkbox"
                            {{ old('is_active', $work->is_active) ? 'checked' : '' }}
                        >
                        <label for="is_active" class="checkbox-label">
                            Activer ce projet
                        </label>
                    </div>
                    <div class="help-text">Les projets inactifs ne s'affichent pas sur le site</div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.work.index') }}" class="btn btn-secondary">
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

@section('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                const img = document.getElementById('preview-img');
                img.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
