@extends('layouts.admin')

@section('title', 'Gestion des Agences - Orchestra Admin')

@section('page-title', 'Gestion des Agences')

@section('styles')
<style>
    .agencies-header {
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

    .agencies-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .agency-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .agency-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .agency-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        position: relative;
    }

    .agency-color-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 6px;
    }

    .agency-content {
        padding: 20px;
    }

    .agency-name {
        font-size: 1.3rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .agency-location {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .agency-description {
        color: #475569;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .agency-services {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 15px;
    }

    .service-tag {
        background: #f3f4f6;
        color: #374151;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .agency-actions {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: #3b82f6;
        color: white;
    }

    .btn-edit:hover {
        background: #2563eb;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    .btn-toggle {
        background: #10b981;
        color: white;
    }

    .btn-toggle:hover {
        background: #059669;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background: #fee2e2;
        color: #dc2626;
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
        color: #475569;
    }

    .empty-state p {
        margin-bottom: 30px;
    }

    @media (max-width: 768px) {
        .agencies-header {
            flex-direction: column;
            gap: 20px;
            align-items: stretch;
        }

        .agencies-grid {
            grid-template-columns: 1fr;
        }

        .agency-actions {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="agencies-header">
    <div>
        <h1 class="page-title">Gestion des Agences</h1>
        <p class="text-muted">Gérez les agences de votre réseau</p>
    </div>
    <a href="{{ route('admin.agency.create') }}" class="add-btn">
        <i class="fas fa-plus"></i>
        Ajouter une agence
    </a>
</div>

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

@if($agencies->count() > 0)
    <div class="agencies-grid">
        @foreach($agencies as $agency)
        <div class="agency-card">
            <div style="position: relative;">
                <img src="{{ asset($agency->image) }}" alt="{{ $agency->name }}" class="agency-image">
                <div class="agency-color-bar" style="background: {{ $agency->color }}"></div>
            </div>
            <div class="agency-content">
                <div class="status-badge {{ $agency->is_active ? 'status-active' : 'status-inactive' }}">
                    {{ $agency->is_active ? 'Active' : 'Inactive' }}
                </div>

                <div class="agency-name">{{ $agency->name }}</div>
                <div class="agency-location">{{ $agency->location }}</div>
                <div class="agency-description">{{ Str::limit($agency->description, 100) }}</div>

                <div class="agency-services">
                    @foreach($agency->services as $service)
                    <span class="service-tag">{{ $service }}</span>
                    @endforeach
                </div>

                <div class="agency-actions">
                    <a href="{{ route('admin.agency.edit', $agency) }}" class="btn btn-edit">
                        <i class="fas fa-edit"></i>
                        Modifier
                    </a>

                    <form action="{{ route('admin.agency.toggle', $agency) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-toggle">
                            <i class="fas fa-{{ $agency->is_active ? 'eye-slash' : 'eye' }}"></i>
                            {{ $agency->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.agency.destroy', $agency) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">
                            <i class="fas fa-trash"></i>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <i class="fas fa-building"></i>
        <h3>Aucune agence trouvée</h3>
        <p>Commencez par ajouter votre première agence.</p>
        <a href="{{ route('admin.agency.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Ajouter une agence
        </a>
    </div>
@endif
@endsection
