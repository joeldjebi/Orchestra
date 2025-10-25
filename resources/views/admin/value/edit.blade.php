@extends('layouts.admin')

@section('title', 'Modifier la Valeur - Orchestra Admin')

@section('page-title', 'Modifier la Valeur')

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

    .form-input.error {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .form-input.error:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
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

    .details-section {
        background: #f8fafc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .details-section h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 15px;
    }

    .detail-input {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
        align-items: center;
    }

    .detail-input input {
        flex: 1;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .add-detail-btn {
        background: #3b82f6;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .add-detail-btn:hover {
        background: #2563eb;
    }

    .remove-detail-btn {
        background: #ef4444;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .remove-detail-btn:hover {
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

        .detail-input {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <a href="{{ route('admin.value.index') }}" class="back-link">
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

        <form action="{{ route('admin.value.update', $value) }}" method="POST">
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
                        value="{{ old('title', $value->title) }}"
                        required
                        placeholder="Ex: Innovation"
                    >
                    @error('title')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="icon" class="form-label">Icône *</label>
                    <input
                        type="text"
                        id="icon"
                        name="icon"
                        class="form-input @error('icon') error @enderror"
                        value="{{ old('icon', $value->icon) }}"
                        required
                        placeholder="Ex: fas fa-lightbulb"
                    >
                    <div class="help-text">Classe CSS de l'icône (FontAwesome)</div>
                    @error('icon')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description *</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-input form-textarea @error('description') error @enderror"
                    required
                    placeholder="Description de la valeur..."
                >{{ old('description', $value->description) }}</textarea>
                @error('description')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="details-section">
                <h3>Détails de la valeur</h3>
                <div id="details-container">
                    @if(old('details'))
                        @foreach(old('details') as $detail)
                        <div class="detail-input">
                            <input type="text" name="details[]" value="{{ $detail }}" required>
                            <button type="button" class="remove-detail-btn" onclick="removeDetail(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @endforeach
                    @else
                        @foreach($value->details as $detail)
                        <div class="detail-input">
                            <input type="text" name="details[]" value="{{ $detail }}" required>
                            <button type="button" class="remove-detail-btn" onclick="removeDetail(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" class="add-detail-btn" onclick="addDetail()">
                    <i class="fas fa-plus"></i> Ajouter un détail
                </button>
                @error('details')
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
                        value="{{ old('order', $value->order) }}"
                        min="0"
                        placeholder="0"
                    >
                    <div class="help-text">Plus le nombre est petit, plus la valeur apparaît en premier</div>
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
                            {{ old('is_active', $value->is_active) ? 'checked' : '' }}
                        >
                        <label for="is_active" class="checkbox-label">
                            Activer cette valeur
                        </label>
                    </div>
                    <div class="help-text">Les valeurs inactives ne s'affichent pas sur le site</div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.value.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Annuler
                </a>
                <input type="submit" value="Mettre à jour" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function addDetail() {
        const container = document.getElementById('details-container');
        const detailInput = document.createElement('div');
        detailInput.className = 'detail-input';
        detailInput.innerHTML = `
            <input type="text" name="details[]" placeholder="Détail de la valeur" required>
            <button type="button" class="remove-detail-btn" onclick="removeDetail(this)">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(detailInput);
        updateRemoveButtons();
    }

    function removeDetail(button) {
        button.parentElement.remove();
        updateRemoveButtons();
    }

    function updateRemoveButtons() {
        const detailInputs = document.querySelectorAll('.detail-input');
        detailInputs.forEach((input, index) => {
            const removeBtn = input.querySelector('.remove-detail-btn');
            if (detailInputs.length === 1) {
                removeBtn.style.display = 'none';
            } else {
                removeBtn.style.display = 'inline-block';
            }
        });
    }

    // Initialiser les boutons de suppression au chargement
    document.addEventListener('DOMContentLoaded', function() {
        updateRemoveButtons();
    });
</script>
@endsection
