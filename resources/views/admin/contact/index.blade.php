@extends('layouts.admin')

@section('title', 'Gestion des Contacts - Orchestra Admin')

@section('page-title', 'Gestion des Contacts')

@section('styles')
<style>
    .contact-header {
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

    .contacts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 25px;
    }

    .contact-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .contact-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .contact-content {
        padding: 25px;
    }

    .contact-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 15px;
    }

    .contact-info {
        margin-bottom: 20px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        color: #64748b;
    }

    .contact-item i {
        width: 20px;
        color: #3b82f6;
    }

    .office-hours {
        margin-bottom: 20px;
    }

    .office-hours h4 {
        font-size: 1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .hours-list {
        list-style: none;
        padding: 0;
    }

    .hours-list li {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
    }

    .hours-list li:last-child {
        border-bottom: none;
    }

    .contact-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        font-size: 0.85rem;
        color: #64748b;
    }

    .contact-status {
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

    .contact-actions {
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
        .contacts-grid {
            grid-template-columns: 1fr;
        }

        .contact-header {
            flex-direction: column;
            gap: 20px;
            align-items: stretch;
        }

        .contact-actions {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<div class="contact-header">
    <div>
        <h1 class="page-title">Gestion des Contacts</h1>
        <p style="color: #64748b; margin-top: 5px;">Gérez les informations de contact du footer</p>
    </div>
    <a href="{{ route('admin.contact.create') }}" class="add-btn">
        <i class="fas fa-plus"></i>
        Ajouter des Informations
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

@if($contacts->count() > 0)
    <div class="contacts-grid">
        @foreach($contacts as $contact)
        <div class="contact-card">
            @if($contact->image)
            <img src="{{ asset($contact->image) }}" alt="{{ $contact->title }}" class="contact-image">
            @endif

            <div class="contact-content">
                <h3 class="contact-title">{{ $contact->title }}</h3>

                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $contact->address }}</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $contact->phone }}</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>{{ $contact->email }}</span>
                    </div>
                </div>

                <div class="office-hours">
                    <h4>Horaires d'ouverture</h4>
                    <ul class="hours-list">
                        @foreach($contact->office_hours as $day => $hours)
                        <li>
                            <strong>{{ $day }}:</strong>
                            <span>{{ $hours }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="contact-meta">
                    <div class="contact-status">
                        <span class="status-badge {{ $contact->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $contact->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                </div>

                <div class="contact-actions">
                    <a href="{{ route('admin.contact.edit', $contact) }}" class="action-btn edit-btn">
                        <i class="fas fa-edit"></i> Modifier
                    </a>

                    <form action="{{ route('admin.contact.toggle', $contact) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="action-btn toggle-btn">
                            <i class="fas fa-{{ $contact->is_active ? 'eye-slash' : 'eye' }}"></i>
                            {{ $contact->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.contact.destroy', $contact) }}" method="POST" style="display: inline;"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ces informations de contact ?')">
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
        <i class="fas fa-address-book"></i>
        <h3>Aucune information de contact trouvée</h3>
        <p>Commencez par ajouter les informations de contact du footer</p>
        <a href="{{ route('admin.contact.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Ajouter les informations
        </a>
    </div>
@endif
@endsection

@section('scripts')
<script>
    // Animation des cartes au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.contact-card');
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
