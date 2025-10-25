@extends('layouts.admin')

@section('title', 'Dashboard - Orchestra Admin')

@section('page-title', 'Dashboard')

@section('styles')
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .stat-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .stat-icon.users {
        background: linear-gradient(135deg, #3b82f6, #1e3a8a);
    }

    .stat-icon.admins {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .stat-icon.regular {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .stat-icon.carousel {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }

    .stat-icon.leadership {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
    }

    .stat-icon.blog {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .stat-icon.values {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .stat-icon.work {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .stat-icon.agencies {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
    }

    .stat-icon.contact {
        background: linear-gradient(135deg, #84cc16, #65a30d);
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .stat-change {
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .stat-change.positive {
        color: #10b981;
    }

    .stat-change.negative {
        color: #ef4444;
    }

    .welcome-section {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        border-radius: 20px;
        padding: 40px;
        color: white;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .welcome-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></svg>');
        background-size: 50px;
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% { transform: translateX(-50px) translateY(-50px) rotate(0deg); }
        100% { transform: translateX(-50px) translateY(-50px) rotate(360deg); }
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .welcome-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 30px;
    }

    .welcome-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .welcome-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 12px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .welcome-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
    }

    .recent-activity {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    .activity-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
    }

    .activity-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
    }

    .activity-list {
        list-style: none;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: white;
    }

    .activity-icon.login {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .activity-icon.register {
        background: linear-gradient(135deg, #3b82f6, #1e3a8a);
    }

    .activity-content {
        flex: 1;
    }

    .activity-text {
        font-weight: 500;
        color: #1e293b;
        margin-bottom: 3px;
    }

    .activity-time {
        font-size: 0.85rem;
        color: #64748b;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .action-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin: 0 auto 15px;
    }

    .action-icon.users {
        background: linear-gradient(135deg, #3b82f6, #1e3a8a);
    }

    .action-icon.settings {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .action-icon.content {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .action-icon.carousel {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }

    .action-icon.leadership {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
    }

    .action-icon.blog {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .action-icon.values {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .action-icon.work {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .action-icon.agencies {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
    }

    .action-icon.contact {
        background: linear-gradient(135deg, #84cc16, #65a30d);
    }

    .action-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .action-description {
        font-size: 0.9rem;
        color: #64748b;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .welcome-section {
            padding: 30px 20px;
        }

        .welcome-title {
            font-size: 2rem;
        }

        .welcome-actions {
            flex-direction: column;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Section de bienvenue -->
<div class="welcome-section">
    <div class="welcome-content">
        <h1 class="welcome-title">Bienvenue, {{ $user->prenoms }} !</h1>
        <p class="welcome-subtitle">
            Voici un aperçu de votre tableau de bord administrateur. Gérez vos utilisateurs et paramètres depuis cette interface.
        </p>
        <div class="welcome-actions">
            <a href="/admin/users" class="welcome-btn">
                <i class="fas fa-users"></i> Gérer les utilisateurs
            </a>
            <a href="/" class="welcome-btn">
                <i class="fas fa-home"></i> Voir le site
            </a>
        </div>
    </div>
</div>

<!-- Statistiques -->
<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-title">Total Utilisateurs</span>
            <div class="stat-icon users">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
        <div class="stat-change positive">
            <i class="fas fa-user-shield"></i>
            <span>{{ $stats['admin_users'] }} admins</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-title">Carousel</span>
            <div class="stat-icon carousel">
                <i class="fas fa-images"></i>
            </div>
        </div>
        <div class="stat-value">{{ $stats['active_carousel'] }}</div>
        <div class="stat-change positive">
            <i class="fas fa-eye"></i>
            <span>{{ $stats['total_carousel'] }} total</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-title">Leadership</span>
            <div class="stat-icon leadership">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="stat-value">{{ $stats['active_leadership'] }}</div>
        <div class="stat-change positive">
            <i class="fas fa-eye"></i>
            <span>{{ $stats['total_leadership'] }} total</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-title">Articles Blog</span>
            <div class="stat-icon blog">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
        <div class="stat-value">{{ $stats['active_blog'] }}</div>
        <div class="stat-change positive">
            <i class="fas fa-eye"></i>
            <span>{{ $stats['total_blog'] }} total</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-title">Valeurs</span>
            <div class="stat-icon values">
                <i class="fas fa-heart"></i>
            </div>
        </div>
        <div class="stat-value">{{ $stats['active_values'] }}</div>
        <div class="stat-change positive">
            <i class="fas fa-eye"></i>
            <span>{{ $stats['total_values'] }} total</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-title">Projets</span>
            <div class="stat-icon work">
                <i class="fas fa-briefcase"></i>
            </div>
        </div>
        <div class="stat-value">{{ $stats['active_work'] }}</div>
        <div class="stat-change positive">
            <i class="fas fa-eye"></i>
            <span>{{ $stats['total_work'] }} total</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-title">Agences</span>
            <div class="stat-icon agencies">
                <i class="fas fa-building"></i>
            </div>
        </div>
        <div class="stat-value">{{ $stats['active_agencies'] }}</div>
        <div class="stat-change positive">
            <i class="fas fa-eye"></i>
            <span>{{ $stats['total_agencies'] }} total</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-title">Contact</span>
            <div class="stat-icon contact">
                <i class="fas fa-address-book"></i>
            </div>
        </div>
        <div class="stat-value">{{ $stats['active_contact'] }}</div>
        <div class="stat-change positive">
            <i class="fas fa-eye"></i>
            <span>{{ $stats['total_contact'] }} total</span>
        </div>
    </div>
</div>

<!-- Actions rapides -->
<div class="quick-actions">
    <a href="/admin/carousel" class="action-card">
        <div class="action-icon carousel">
            <i class="fas fa-images"></i>
        </div>
        <h3 class="action-title">Carousel</h3>
        <p class="action-description">
            Gérez les slides du carousel principal de la page d'accueil.
        </p>
    </a>

    <a href="/admin/leadership" class="action-card">
        <div class="action-icon leadership">
            <i class="fas fa-users"></i>
        </div>
        <h3 class="action-title">Leadership</h3>
        <p class="action-description">
            Gérez les membres de l'équipe de direction.
        </p>
    </a>

    <a href="/admin/blog" class="action-card">
        <div class="action-icon blog">
            <i class="fas fa-newspaper"></i>
        </div>
        <h3 class="action-title">Blog</h3>
        <p class="action-description">
            Créez et gérez les articles de blog et de presse.
        </p>
    </a>

    <a href="/admin/value" class="action-card">
        <div class="action-icon values">
            <i class="fas fa-heart"></i>
        </div>
        <h3 class="action-title">Valeurs</h3>
        <p class="action-description">
            Définissez et gérez les valeurs de l'entreprise.
        </p>
    </a>

    <a href="/admin/work" class="action-card">
        <div class="action-icon work">
            <i class="fas fa-briefcase"></i>
        </div>
        <h3 class="action-title">Projets</h3>
        <p class="action-description">
            Gérez les projets et réalisations clients.
        </p>
    </a>

    <a href="/admin/agency" class="action-card">
        <div class="action-icon agencies">
            <i class="fas fa-building"></i>
        </div>
        <h3 class="action-title">Agences</h3>
        <p class="action-description">
            Gérez les informations des différentes agences.
        </p>
    </a>

    <a href="/admin/contact" class="action-card">
        <div class="action-icon contact">
            <i class="fas fa-address-book"></i>
        </div>
        <h3 class="action-title">Contact</h3>
        <p class="action-description">
            Configurez les informations de contact et footer.
        </p>
    </a>

    <a href="/admin/users" class="action-card">
        <div class="action-icon users">
            <i class="fas fa-users"></i>
        </div>
        <h3 class="action-title">Utilisateurs</h3>
        <p class="action-description">
            Gérez les utilisateurs et administrateurs du système.
        </p>
    </a>

    <a href="/admin/settings" class="action-card">
        <div class="action-icon settings">
            <i class="fas fa-cog"></i>
        </div>
        <h3 class="action-title">Paramètres</h3>
        <p class="action-description">
            Configurez les paramètres généraux du système.
        </p>
    </a>
</div>

<!-- Activité récente -->
<div class="recent-activity">
    <div class="activity-header">
        <h2 class="activity-title">Activité Récente</h2>
        <a href="/admin/activity" style="color: #3b82f6; text-decoration: none; font-weight: 500;">
            Voir tout
        </a>
    </div>

    <ul class="activity-list">
        <li class="activity-item">
            <div class="activity-icon login">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <div class="activity-content">
                <div class="activity-text">Connexion réussie</div>
                <div class="activity-time">Il y a 2 minutes</div>
            </div>
        </li>

        <li class="activity-item">
            <div class="activity-icon register">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="activity-content">
                <div class="activity-text">Nouvel utilisateur inscrit</div>
                <div class="activity-time">Il y a 1 heure</div>
            </div>
        </li>

        <li class="activity-item">
            <div class="activity-icon login">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <div class="activity-content">
                <div class="activity-text">Connexion administrateur</div>
                <div class="activity-time">Il y a 3 heures</div>
            </div>
        </li>
    </ul>
</div>
@endsection

@section('scripts')
<script>
    // Animation des cartes au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.stat-card, .action-card');
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
