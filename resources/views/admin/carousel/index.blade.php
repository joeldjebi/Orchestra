@extends('layouts.admin')

@section('title', 'Gestion du Carousel - Orchestra Admin')

@section('page-title', 'Gestion du Carousel')

@section('styles')
<style>
    .carousel-header {
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

    .slides-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
    }

    .slide-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .slide-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .slide-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .slide-content {
        padding: 20px;
    }

    .slide-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .slide-items {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .slide-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        font-size: 0.85rem;
        color: #64748b;
    }

    .slide-order {
        background: #f1f5f9;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 500;
    }

    .slide-status {
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

    .slide-actions {
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
        .slides-grid {
            grid-template-columns: 1fr;
        }

        .carousel-header {
            flex-direction: column;
            gap: 20px;
            align-items: stretch;
        }

        .slide-actions {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<div class="carousel-header">
    <div>
        <h1 class="page-title">Gestion du Carousel</h1>
        <p style="color: #64748b; margin-top: 5px;">Gérez les slides du carousel principal de votre site</p>
    </div>
    <a href="{{ route('admin.carousel.create') }}" class="add-btn">
        <i class="fas fa-plus"></i>
        Ajouter un Slide
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

@if($slides->count() > 0)
    <div class="slides-grid">
        @foreach($slides as $slide)
        <div class="slide-card">
            <img src="{{ asset($slide->image) }}" alt="{{ $slide->alt }}" class="slide-image">

            <div class="slide-content">
                <h3 class="slide-title">{{ $slide->title }}</h3>

                <div class="slide-items">
                    @if($slide->items && count($slide->items) > 0)
                        <strong>Items :</strong>
                        <ul style="margin: 5px 0 0 20px;">
                            @foreach(array_slice($slide->items, 0, 3) as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                            @if(count($slide->items) > 3)
                                <li><em>... et {{ count($slide->items) - 3 }} autres</em></li>
                            @endif
                        </ul>
                    @endif
                </div>

                <div class="slide-meta">
                    <span class="slide-order">Ordre: {{ $slide->order }}</span>
                    <div class="slide-status">
                        <span class="status-badge {{ $slide->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $slide->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                </div>

                <div class="slide-actions">
                    <a href="{{ route('admin.carousel.edit', $slide) }}" class="action-btn edit-btn">
                        <i class="fas fa-edit"></i> Modifier
                    </a>

                    <form action="{{ route('admin.carousel.toggle', $slide) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="action-btn toggle-btn">
                            <i class="fas fa-{{ $slide->is_active ? 'eye-slash' : 'eye' }}"></i>
                            {{ $slide->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.carousel.destroy', $slide) }}" method="POST" style="display: inline;"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce slide ?')">
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
        <i class="fas fa-images"></i>
        <h3>Aucun slide trouvé</h3>
        <p>Commencez par ajouter votre premier slide au carousel</p>
        <a href="{{ route('admin.carousel.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Ajouter le premier slide
        </a>
    </div>
@endif
@endsection

@section('scripts')
<script>
    // Animation des cartes au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.slide-card');
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
