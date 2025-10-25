@extends('layouts.admin')

@section('title', 'Modifier l\'Article - Orchestra Admin')

@section('page-title', 'Modifier l\'Article')

@section('styles')
<style>
    .form-container {
        max-width: 1000px;
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

    .content-section {
        background: #f8fafc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .content-section h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 15px;
    }

    .paragraph-group {
        margin-bottom: 20px;
    }

    .paragraph-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #4b5563;
        font-size: 0.9rem;
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

    .layout-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .layout-option {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .layout-option:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    .layout-option input[type="radio"] {
        margin: 0;
    }

    .layout-option.selected {
        border-color: #3b82f6;
        background: #eff6ff;
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

        .layout-options {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <a href="{{ route('admin.blog.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Retour à la liste
    </a>

    <div class="form-card">
        <form action="{{ route('admin.blog.update', $blog) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="title" class="form-label">Titre *</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-input @error('title') error @enderror"
                        value="{{ old('title', $blog->title) }}"
                        required
                        placeholder="Ex: Innovation"
                    >
                    @error('title')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sidebar_title" class="form-label">Titre de la sidebar *</label>
                    <input
                        type="text"
                        id="sidebar_title"
                        name="sidebar_title"
                        class="form-input @error('sidebar_title') error @enderror"
                        value="{{ old('sidebar_title', $blog->sidebar_title) }}"
                        required
                        placeholder="Ex: INNOVATION"
                    >
                    @error('sidebar_title')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="headline" class="form-label">Titre principal *</label>
                <input
                    type="text"
                    id="headline"
                    name="headline"
                    class="form-input @error('headline') error @enderror"
                    value="{{ old('headline', $blog->headline) }}"
                    required
                    placeholder="Ex: L'innovation au cœur de notre stratégie"
                >
                @error('headline')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            @if($blog->image)
            <div class="form-group">
                <label class="form-label">Image actuelle</label>
                <div class="current-image">
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                </div>
            </div>
            @endif

            <div class="form-group">
                <label for="image" class="form-label">Nouvelle image (optionnel)</label>
                <div class="file-input">
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        onchange="previewImage(this)"
                    >
                    <label for="image" class="file-input-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <div>
                            <div style="font-weight: 600; margin-bottom: 5px;">Cliquez pour changer l'image</div>
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

            <div class="content-section">
                <h3>Contenu de l'article</h3>

                <div class="paragraph-group">
                    <label for="content_paragraph1" class="paragraph-label">Paragraphe 1 *</label>
                    <textarea
                        id="content_paragraph1"
                        name="content[paragraph1]"
                        class="form-input form-textarea @error('content.paragraph1') error @enderror"
                        required
                        placeholder="Premier paragraphe de l'article..."
                    >{{ old('content.paragraph1', $blog->content['paragraph1'] ?? '') }}</textarea>
                    @error('content.paragraph1')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="paragraph-group">
                    <label for="content_paragraph2" class="paragraph-label">Paragraphe 2 *</label>
                    <textarea
                        id="content_paragraph2"
                        name="content[paragraph2]"
                        class="form-input form-textarea @error('content.paragraph2') error @enderror"
                        required
                        placeholder="Deuxième paragraphe de l'article..."
                    >{{ old('content.paragraph2', $blog->content['paragraph2'] ?? '') }}</textarea>
                    @error('content.paragraph2')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="paragraph-group">
                    <label for="content_paragraph3" class="paragraph-label">Paragraphe 3 *</label>
                    <textarea
                        id="content_paragraph3"
                        name="content[paragraph3]"
                        class="form-input form-textarea @error('content.paragraph3') error @enderror"
                        required
                        placeholder="Troisième paragraphe de l'article..."
                    >{{ old('content.paragraph3', $blog->content['paragraph3'] ?? '') }}</textarea>
                    @error('content.paragraph3')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="paragraph-group">
                    <label for="content_paragraph4" class="paragraph-label">Paragraphe 4 *</label>
                    <textarea
                        id="content_paragraph4"
                        name="content[paragraph4]"
                        class="form-input form-textarea @error('content.paragraph4') error @enderror"
                        required
                        placeholder="Quatrième paragraphe de l'article..."
                    >{{ old('content.paragraph4', $blog->content['paragraph4'] ?? '') }}</textarea>
                    @error('content.paragraph4')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="paragraph-group">
                    <label for="content_paragraph5" class="paragraph-label">Paragraphe 5 *</label>
                    <textarea
                        id="content_paragraph5"
                        name="content[paragraph5]"
                        class="form-input form-textarea @error('content.paragraph5') error @enderror"
                        required
                        placeholder="Cinquième paragraphe de l'article..."
                    >{{ old('content.paragraph5', $blog->content['paragraph5'] ?? '') }}</textarea>
                    @error('content.paragraph5')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Layout du titre *</label>
                    <div class="layout-options">
                        <label class="layout-option {{ old('layout', $blog->layout) === 'left' ? 'selected' : '' }}">
                            <input type="radio" name="layout" value="left" {{ old('layout', $blog->layout) === 'left' ? 'checked' : '' }}>
                            <div>
                                <div style="font-weight: 600; margin-bottom: 5px;">Titre à gauche</div>
                                <div style="font-size: 0.9rem; color: #64748b;">Contenu principal à gauche, sidebar à droite</div>
                            </div>
                        </label>
                        <label class="layout-option {{ old('layout', $blog->layout) === 'right' ? 'selected' : '' }}">
                            <input type="radio" name="layout" value="right" {{ old('layout', $blog->layout) === 'right' ? 'checked' : '' }}>
                            <div>
                                <div style="font-weight: 600; margin-bottom: 5px;">Titre à droite</div>
                                <div style="font-size: 0.9rem; color: #64748b;">Sidebar à gauche, contenu principal à droite</div>
                            </div>
                        </label>
                    </div>
                    @error('layout')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="order" class="form-label">Ordre d'affichage</label>
                    <input
                        type="number"
                        id="order"
                        name="order"
                        class="form-input @error('order') error @enderror"
                        value="{{ old('order', $blog->order) }}"
                        min="0"
                        placeholder="0"
                    >
                    <div class="help-text">Plus le nombre est petit, plus l'article apparaît en premier</div>
                    @error('order')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input
                        type="checkbox"
                        id="is_active"
                        name="is_active"
                        class="checkbox"
                        {{ old('is_active', $blog->is_active) ? 'checked' : '' }}
                    >
                    <label for="is_active" class="checkbox-label">
                        Activer cet article
                    </label>
                </div>
                <div class="help-text">Les articles inactifs ne s'affichent pas sur le site</div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
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

    // Gestion des options de layout
    document.addEventListener('DOMContentLoaded', function() {
        const layoutOptions = document.querySelectorAll('.layout-option');

        layoutOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Retirer la classe selected de toutes les options
                layoutOptions.forEach(opt => opt.classList.remove('selected'));

                // Ajouter la classe selected à l'option cliquée
                this.classList.add('selected');

                // Sélectionner le radio button correspondant
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
            });
        });

        // Animation du formulaire
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
