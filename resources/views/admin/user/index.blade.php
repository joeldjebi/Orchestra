@extends('layouts.admin')

@section('title', 'Gestion des Utilisateurs - Orchestra Admin')

@section('page-title', 'Gestion des Utilisateurs')

@section('styles')
<style>
    .users-header {
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

    .users-table {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        background: #f8fafc;
        padding: 20px;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
    }

    .table td {
        padding: 20px;
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
    }

    .table tr:hover {
        background: #f8fafc;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #1e3a8a);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .user-details h4 {
        font-size: 1rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 4px 0;
    }

    .user-details p {
        font-size: 0.85rem;
        color: #64748b;
        margin: 0;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background: #fee2e2;
        color: #dc2626;
    }

    .role-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .role-admin {
        background: #dbeafe;
        color: #1e40af;
    }

    .role-user {
        background: #f3f4f6;
        color: #374151;
    }

    .user-actions {
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
        .users-header {
            flex-direction: column;
            gap: 20px;
            align-items: stretch;
        }

        .table {
            font-size: 0.9rem;
        }

        .table th,
        .table td {
            padding: 12px 8px;
        }

        .user-actions {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="users-header">
    <div>
        <h1 class="page-title">Gestion des Utilisateurs</h1>
        <p class="text-muted">Gérez les utilisateurs du système</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="add-btn">
        <i class="fas fa-plus"></i>
        Ajouter un utilisateur
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

@if($users->count() > 0)
    <div class="users-table">
        <table class="table">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Créé le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr($user->nom, 0, 1)) }}{{ strtoupper(substr($user->prenoms, 0, 1)) }}
                            </div>
                            <div class="user-details">
                                <h4>{{ $user->nom }} {{ $user->prenoms }}</h4>
                                <p>ID: {{ $user->id }}</p>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="role-badge {{ $user->is_admin ? 'role-admin' : 'role-user' }}">
                            {{ $user->is_admin ? 'Administrateur' : 'Utilisateur' }}
                        </span>
                    </td>
                    <td>
                        <span class="status-badge {{ $user->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $user->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="user-actions">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-edit">
                                <i class="fas fa-edit"></i>
                                Modifier
                            </a>

                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.toggle', $user) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-toggle">
                                    <i class="fas fa-{{ $user->is_active ? 'eye-slash' : 'eye' }}"></i>
                                    {{ $user->is_active ? 'Désactiver' : 'Activer' }}
                                </button>
                            </form>

                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    <i class="fas fa-trash"></i>
                                    Supprimer
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="empty-state">
        <i class="fas fa-users"></i>
        <h3>Aucun utilisateur trouvé</h3>
        <p>Commencez par ajouter votre premier utilisateur.</p>
        <a href="{{ route('admin.users.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Ajouter un utilisateur
        </a>
    </div>
@endif
@endsection
