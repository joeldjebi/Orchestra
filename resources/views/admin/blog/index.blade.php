@extends('layouts.admin')

@section('title', 'Gestion des Articles de Blog - Orchestra Admin')

@section('page-title', 'Gestion des Articles de Blog')

@section('styles')
<style>
    .blog-header {
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

    .articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
        gap: 25px;
    }

    .article-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .article-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .article-content {
        padding: 25px;
    }

    .article-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .article-headline {
        font-size: 1.1rem;
        font-weight: 500;
        color: #4A709B;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .article-preview {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 15px;
        max-height: 100px;
        overflow: hidden;
        position: relative;
    }

    .article-preview::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 20px;
        background: linear-gradient(transparent, white);
    }

    .article-sidebar {
        background: #f8fafc;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .sidebar-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    .article-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        font-size: 0.85rem;
        color: #64748b;
    }

    .article-order {
        background: #f1f5f9;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 500;
    }

    .article-layout {
        background: #e0f2fe;
        color: #0369a1;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 500;
        text-transform: capitalize;
    }

    .article-status {
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

    .article-actions {
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
        .articles-grid {
            grid-template-columns: 1fr;
        }

        .blog-header {
            flex-direction: column;
            gap: 20px;
            align-items: stretch;
        }

        .article-actions {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<div class="blog-header">
    <div>
        <h1 class="page-title">Gestion des Articles de Blog</h1>
        <p style="color: #64748b; margin-top: 5px;">Gérez les articles de la page blog/press</p>
    </div>
    <a href="{{ route('admin.blog.create') }}" class="add-btn">
        <i class="fas fa-plus"></i>
        Ajouter un Article
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

@if($articles->count() > 0)
    <div class="articles-grid">
        @foreach($articles as $article)
        <div class="article-card">
            @if($article->image)
            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="article-image">
            @endif

            <div class="article-content">
                <h3 class="article-title">{{ $article->title }}</h3>
                <div class="article-headline">{{ $article->headline }}</div>

                <div class="article-preview">
                    {{ Str::limit($article->content['paragraph1'] ?? '', 200) }}
                </div>

                <div class="article-sidebar">
                    <div class="sidebar-title">{{ $article->sidebar_title }}</div>
                </div>

                <div class="article-meta">
                    <div class="article-order">Ordre: {{ $article->order }}</div>
                    <div class="article-layout">{{ $article->layout }}</div>
                    <div class="article-status">
                        <span class="status-badge {{ $article->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $article->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                </div>

                <div class="article-actions">
                    <a href="{{ route('admin.blog.edit', $article) }}" class="action-btn edit-btn">
                        <i class="fas fa-edit"></i> Modifier
                    </a>

                    <form action="{{ route('admin.blog.toggle', $article) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="action-btn toggle-btn">
                            <i class="fas fa-{{ $article->is_active ? 'eye-slash' : 'eye' }}"></i>
                            {{ $article->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.blog.destroy', $article) }}" method="POST" style="display: inline;"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
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
        <i class="fas fa-newspaper"></i>
        <h3>Aucun article trouvé</h3>
        <p>Commencez par ajouter votre premier article de blog</p>
        <a href="{{ route('admin.blog.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Ajouter le premier article
        </a>
    </div>
@endif
@endsection

@section('scripts')
<script>
    // Animation des cartes au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.article-card');
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
