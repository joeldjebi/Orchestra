@extends('layouts.admin')

@section('title', 'Gestion des Valeurs - Orchestra Admin')

@section('page-title', 'Gestion des Valeurs')

@section('styles')
<style>
    .values-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .add-btn {
        background: linear-gradient(135deg, #3b82f6, #1e3a8a);
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 25px;
    }

    .value-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .value-content {
        padding: 25px;
    }

    .value-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        display: block;
    }

    .value-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .value-description {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .value-details {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-bottom: 15px;
    }

    .value-details li {
        color: #6b7280;
        margin-bottom: 5px;
        position: relative;
        padding-left: 20px;
        font-size: 0.9rem;
    }

    .value-details li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #10b981;
        font-weight: bold;
    }

    .value-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        font-size: 0.85rem;
        color: #64748b;
    }

    .value-order {
        background: #f1f5f9;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 500;
    }

    .value-status {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .status-badge {
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .status-active {
        background: #dcfce7;
        color: #166534;
    }

    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    .value-actions {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .edit-btn {
        background: #3b82f6;
        color: white;
    }

    .edit-btn:hover {
        background: #2563eb;
    }

    .toggle-btn {
        background: #10b981;
        color: white;
    }

    .toggle-btn:hover {
        background: #059669;
    }

    .delete-btn {
        background: #ef4444;
        color: white;
    }

    .delete-btn:hover {
        background: #dc2626;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #cbd5e1;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #1e293b;
    }

    .empty-state p {
        margin-bottom: 30px;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    @media (max-width: 768px) {
        .values-grid {
            grid-template-columns: 1fr;
        }

        .values-header {
            flex-direction: column;
            gap: 20px;
            align-items: stretch;
        }

        .value-actions {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<div class="values-header">
    <div>
        <h1 class="page-title">Gestion des Valeurs</h1>
        <p style="color: #64748b; margin-top: 5px;">Gérez les valeurs de l'entreprise</p>
    </div>
    <a href="{{ route('admin.value.create') }}" class="add-btn">
        <i class="fas fa-plus"></i>
        Ajouter une Valeur
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
@endif

@if($values->count() > 0)
    <div class="values-grid">
        @foreach($values as $value)
        <div class="value-card">
            <div class="value-content">
                <i class="{{ $value->icon }} value-icon"></i>
                <h3 class="value-title">{{ $value->title }}</h3>
                <p class="value-description">{{ $value->description }}</p>

                <ul class="value-details">
                    @foreach($value->details as $detail)
                    <li>{{ $detail }}</li>
                    @endforeach
                </ul>

                <div class="value-meta">
                    <div class="value-order">Ordre: {{ $value->order }}</div>
                    <div class="value-status">
                        <span class="status-badge {{ $value->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $value->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                </div>

                <div class="value-actions">
                    <a href="{{ route('admin.value.edit', $value) }}" class="action-btn edit-btn">
                        <i class="fas fa-edit"></i> Modifier
                    </a>

                    <form action="{{ route('admin.value.toggle', $value) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="action-btn toggle-btn">
                            <i class="fas fa-{{ $value->is_active ? 'eye-slash' : 'eye' }}"></i>
                            {{ $value->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.value.destroy', $value) }}" method="POST" style="display: inline;"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette valeur ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete-btn">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <i class="fas fa-heart"></i>
        <h3>Aucune valeur trouvée</h3>
        <p>Commencez par ajouter votre première valeur</p>
        <a href="{{ route('admin.value.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Ajouter la première valeur
        </a>
    </div>
@endif
@endsection

@section('scripts')
<script>
    // Animation des cartes au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.value-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endsection
