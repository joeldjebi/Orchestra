@extends('layouts.admin')

@section('title', 'Gestion du Leadership - Orchestra Admin')

@section('page-title', 'Gestion du Leadership')

@section('styles')
<style>
    .leadership-header {
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

    .members-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
    }

    .member-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .member-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .member-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .member-content {
        padding: 20px;
    }

    .member-name {
        font-size: 1.3rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .member-position {
        color: #3b82f6;
        font-weight: 500;
        margin-bottom: 15px;
    }

    .member-description {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .member-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        font-size: 0.85rem;
        color: #64748b;
    }

    .member-order {
        background: #f1f5f9;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 500;
    }

    .member-status {
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

    .member-actions {
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
        .members-grid {
            grid-template-columns: 1fr;
        }

        .leadership-header {
            flex-direction: column;
            gap: 20px;
            align-items: stretch;
        }

        .member-actions {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<div class="leadership-header">
    <div>
        <h1 class="page-title">Gestion du Leadership</h1>
        <p style="color: #64748b; margin-top: 5px;">Gérez les membres de l'équipe de direction</p>
    </div>
    <a href="{{ route('admin.leadership.create') }}" class="add-btn">
        <i class="fas fa-user-plus"></i>
        Ajouter un Membre
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

@if($members->count() > 0)
    <div class="members-grid">
        @foreach($members as $member)
        <div class="member-card">
            <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" class="member-image">

            <div class="member-content">
                <h3 class="member-name">{{ $member->name }}</h3>
                <div class="member-position">{{ $member->position }}</div>

                @if($member->description)
                <div class="member-description">
                    {{ Str::limit($member->description, 100) }}
                </div>
                @endif

                <div class="member-meta">
                    <span class="member-order">Ordre: {{ $member->order }}</span>
                    <div class="member-status">
                        <span class="status-badge {{ $member->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $member->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                </div>

                <div class="member-actions">
                    <a href="{{ route('admin.leadership.edit', $member) }}" class="action-btn edit-btn">
                        <i class="fas fa-edit"></i> Modifier
                    </a>

                    <form action="{{ route('admin.leadership.toggle', $member) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="action-btn toggle-btn">
                            <i class="fas fa-{{ $member->is_active ? 'eye-slash' : 'eye' }}"></i>
                            {{ $member->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.leadership.destroy', $member) }}" method="POST" style="display: inline;"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">
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
        <i class="fas fa-users"></i>
        <h3>Aucun membre trouvé</h3>
        <p>Commencez par ajouter votre premier membre de l'équipe de direction</p>
        <a href="{{ route('admin.leadership.create') }}" class="add-btn">
            <i class="fas fa-user-plus"></i>
            Ajouter le premier membre
        </a>
    </div>
@endif
@endsection

@section('scripts')
<script>
    // Animation des cartes au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.member-card');
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
