@extends('layouts.admin')

@section('title', 'Ajouter des Informations de Contact - Orchestra Admin')

@section('page-title', 'Ajouter des Informations de Contact')

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

    .hours-section {
        background: #f8fafc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .hours-section h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 15px;
    }

    .hours-input {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }

    .hours-input input {
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .add-hours-btn {
        background: #3b82f6;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .add-hours-btn:hover {
        background: #2563eb;
    }

    .remove-hours-btn {
        background: #ef4444;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .remove-hours-btn:hover {
        background: #dc2626;
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

        .hours-input {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <a href="{{ route('admin.contact.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Retour à la liste
    </a>

    <div class="form-card">
        <form action="{{ route('admin.contact.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">Titre *</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    class="form-input @error('title') error @enderror"
                    value="{{ old('title') }}"
                    required
                    placeholder="Ex: Contact Us"
                >
                @error('title')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Adresse *</label>
                <textarea
                    id="address"
                    name="address"
                    class="form-input form-textarea @error('address') error @enderror"
                    required
                    placeholder="Ex: 123 Innovation Drive, Tech Park, City, State, Zip Code"
                >{{ old('address') }}</textarea>
                @error('address')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone" class="form-label">Téléphone *</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="form-input @error('phone') error @enderror"
                        value="{{ old('phone') }}"
                        required
                        placeholder="Ex: (123) 456 7890"
                    >
                    @error('phone')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email *</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input @error('email') error @enderror"
                        value="{{ old('email') }}"
                        required
                        placeholder="Ex: contact@orchestra.com"
                    >
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="hours-section">
                <h3>Horaires d'ouverture</h3>
                <div id="hours-container">
                    <div class="hours-input">
                        <input type="text" name="office_hours[Monday - Friday]" placeholder="Jour (ex: Monday - Friday)" value="{{ old('office_hours.Monday - Friday', 'Monday - Friday') }}">
                        <input type="text" name="office_hours[Monday - Friday]" placeholder="Horaires (ex: 9:00 AM - 5:00 PM)" value="{{ old('office_hours.Monday - Friday', '9:00 AM - 5:00 PM') }}">
                    </div>
                    <div class="hours-input">
                        <input type="text" name="office_hours[Saturday]" placeholder="Jour (ex: Saturday)" value="{{ old('office_hours.Saturday', 'Saturday') }}">
                        <input type="text" name="office_hours[Saturday]" placeholder="Horaires (ex: 10:00 AM - 2:00 PM)" value="{{ old('office_hours.Saturday', '10:00 AM - 2:00 PM') }}">
                    </div>
                    <div class="hours-input">
                        <input type="text" name="office_hours[Sunday]" placeholder="Jour (ex: Sunday)" value="{{ old('office_hours.Sunday', 'Sunday') }}">
                        <input type="text" name="office_hours[Sunday]" placeholder="Horaires (ex: Closed)" value="{{ old('office_hours.Sunday', 'Closed') }}">
                    </div>
                </div>
                @error('office_hours')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Image (optionnel)</label>
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
                            <div style="font-weight: 600; margin-bottom: 5px;">Cliquez pour sélectionner une image</div>
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
                        Activer ces informations
                    </label>
                </div>
                <div class="help-text">Les informations inactives ne s'affichent pas sur le site</div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Créer les informations
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
