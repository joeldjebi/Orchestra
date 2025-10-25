@extends('layouts.admin')

@section('title', 'Modifier l\'Agence - Orchestra Admin')

@section('page-title', 'Modifier l\'Agence')

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

    .services-section {
        background: #f8fafc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .services-section h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 15px;
    }

    .service-input {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
        align-items: center;
    }

    .service-input input {
        flex: 1;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .add-service-btn {
        background: #3b82f6;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .add-service-btn:hover {
        background: #2563eb;
    }

    .remove-service-btn {
        background: #ef4444;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .remove-service-btn:hover {
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

    .color-input {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .color-picker {
        width: 50px;
        height: 40px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .service-input {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <a href="{{ route('admin.agency.index') }}" class="back-link">
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

        <form action="{{ route('admin.agency.update', $agency) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="name" class="form-label">Nom de l'agence *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-input @error('name') error @enderror"
                        value="{{ old('name', $agency->name) }}"
                        required
                        placeholder="Ex: Agence Paris"
                    >
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="location" class="form-label">Localisation *</label>
                    <input
                        type="text"
                        id="location"
                        name="location"
                        class="form-input @error('location') error @enderror"
                        value="{{ old('location', $agency->location) }}"
                        required
                        placeholder="Ex: Paris, France"
                    >
                    @error('location')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Image</label>

                @if($agency->image)
                <div class="current-image">
                    <p style="margin-bottom: 10px; color: #64748b; font-size: 0.9rem;">Image actuelle :</p>
                    <img src="{{ asset($agency->image) }}" alt="{{ $agency->name }}">
                </div>
                @endif

                <div class="file-input">
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    <label for="image" class="file-input-label">
                        <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; margin-bottom: 10px; color: #6b7280;"></i>
                        <div>{{ $agency->image ? 'Cliquez pour changer l\'image' : 'Cliquez pour sélectionner une image' }}</div>
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
                <label for="description" class="form-label">Description *</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-input form-textarea @error('description') error @enderror"
                    required
                    placeholder="Description de l'agence..."
                >{{ old('description', $agency->description) }}</textarea>
                @error('description')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="services-section">
                <h3>Services de l'agence</h3>
                <div id="services-container">
                    @if(old('services'))
                        @foreach(old('services') as $service)
                        <div class="service-input">
                            <input type="text" name="services[]" value="{{ $service }}" required>
                            <button type="button" class="remove-service-btn" onclick="removeService(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @endforeach
                    @else
                        @foreach($agency->services as $service)
                        <div class="service-input">
                            <input type="text" name="services[]" value="{{ $service }}" required>
                            <button type="button" class="remove-service-btn" onclick="removeService(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" class="add-service-btn" onclick="addService()">
                    <i class="fas fa-plus"></i> Ajouter un service
                </button>
                @error('services')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="color" class="form-label">Couleur de la barre *</label>
                    <div class="color-input">
                        <input
                            type="color"
                            id="color"
                            name="color"
                            class="color-picker @error('color') error @enderror"
                            value="{{ old('color', $agency->color) }}"
                            required
                        >
                        <input
                            type="text"
                            id="color-text"
                            class="form-input"
                            value="{{ old('color', $agency->color) }}"
                            readonly
                            style="flex: 1;"
                        >
                    </div>
                    <div class="help-text">Couleur de la barre en bas de l'image</div>
                    @error('color')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url" class="form-label">URL du site web</label>
                    <input
                        type="url"
                        id="url"
                        name="url"
                        class="form-input @error('url') error @enderror"
                        value="{{ old('url', $agency->url) }}"
                        placeholder="https://exemple.com"
                    >
                    @error('url')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="order" class="form-label">Ordre d'affichage</label>
                    <input
                        type="number"
                        id="order"
                        name="order"
                        class="form-input @error('order') error @enderror"
                        value="{{ old('order', $agency->order) }}"
                        min="0"
                        placeholder="0"
                    >
                    <div class="help-text">Plus le nombre est petit, plus l'agence apparaît en premier</div>
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
                            {{ old('is_active', $agency->is_active) ? 'checked' : '' }}
                        >
                        <label for="is_active" class="checkbox-label">
                            Activer cette agence
                        </label>
                    </div>
                    <div class="help-text">Les agences inactives ne s'affichent pas sur le site</div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.agency.index') }}" class="btn btn-secondary">
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

    function addService() {
        const container = document.getElementById('services-container');
        const serviceInput = document.createElement('div');
        serviceInput.className = 'service-input';
        serviceInput.innerHTML = `
            <input type="text" name="services[]" placeholder="Service de l'agence" required>
            <button type="button" class="remove-service-btn" onclick="removeService(this)">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(serviceInput);
        updateRemoveButtons();
    }

    function removeService(button) {
        button.parentElement.remove();
        updateRemoveButtons();
    }

    function updateRemoveButtons() {
        const serviceInputs = document.querySelectorAll('.service-input');
        serviceInputs.forEach((input, index) => {
            const removeBtn = input.querySelector('.remove-service-btn');
            if (serviceInputs.length === 1) {
                removeBtn.style.display = 'none';
            } else {
                removeBtn.style.display = 'inline-block';
            }
        });
    }

    // Synchroniser le color picker avec le champ texte
    document.getElementById('color').addEventListener('input', function() {
        document.getElementById('color-text').value = this.value;
    });

    // Initialiser les boutons de suppression au chargement
    document.addEventListener('DOMContentLoaded', function() {
        updateRemoveButtons();
    });
</script>
@endsection
