@extends('layouts.admin')

@section('title', 'Gestion des Projets - Orchestra Admin')

@section('page-title', 'Gestion des Projets')

@section('styles')
<style>
    .projects-header {
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

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .project-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .project-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .project-content {
        padding: 20px;
    }

    .project-client {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .project-category {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .project-description {
        color: #475569;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .project-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
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
        .projects-header {
            flex-direction: column;
            gap: 20px;
            align-items: stretch;
        }

        .projects-grid {
            grid-template-columns: 1fr;
        }

        .project-actions {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="projects-header">
    <div>
        <h1 class="page-title">Gestion des Projets</h1>
        <p class="text-muted">Gérez les projets de votre portfolio</p>
    </div>
    <a href="{{ route('admin.work.create') }}" class="add-btn">
        <i class="fas fa-plus"></i>
        Ajouter un projet
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

@if($projects->count() > 0)
    <div class="projects-grid">
        @foreach($projects as $project)
        <div class="project-card">
            <img src="{{ asset($project->image) }}" alt="{{ $project->client }}" class="project-image">
            <div class="project-content">
                <div class="status-badge {{ $project->is_active ? 'status-active' : 'status-inactive' }}">
                    {{ $project->is_active ? 'Actif' : 'Inactif' }}
                </div>

                <div class="project-client">{{ $project->client }}</div>

                @if($project->category)
                <div class="project-category">{{ $project->category }}</div>
                @endif

                @if($project->description)
                <div class="project-description">{{ Str::limit($project->description, 100) }}</div>
                @endif

                <div class="project-actions">
                    <a href="{{ route('admin.work.edit', $project) }}" class="btn btn-edit">
                        <i class="fas fa-edit"></i>
                        Modifier
                    </a>

                    <form action="{{ route('admin.work.toggle', $project) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-toggle">
                            <i class="fas fa-{{ $project->is_active ? 'eye-slash' : 'eye' }}"></i>
                            {{ $project->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.work.destroy', $project) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
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
        <i class="fas fa-briefcase"></i>
        <h3>Aucun projet trouvé</h3>
        <p>Commencez par ajouter votre premier projet de portfolio.</p>
        <a href="{{ route('admin.work.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Ajouter un projet
        </a>
    </div>
@endif
@endsection
