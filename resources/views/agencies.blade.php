@extends('layouts.app')

@section('title', 'Our Agencies - Orchestra')

@section('styles')
<style>
        body {
            background: #1e3a8a;
            color: white;
        }

        /* Agencies Section */
        .agencies-section {
            min-height: 100vh;
            padding: 120px 60px 80px;
            background: #1e3a8a;
        }

        .agencies-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .agencies-title {
            font-size: 4rem;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            line-height: 1.1;
            text-align: center;
        }

        .agencies-subtitle {
            font-size: 1.5rem;
            color: #93c5fd;
            text-align: center;
            margin-bottom: 80px;
            font-weight: 300;
        }

        .agencies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }

        .agency-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .agency-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .agency-image {
            height: 200px;
            position: relative;
            overflow: hidden;
        }

        .agency-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .agency-card:hover .agency-image img {
            transform: scale(1.05);
        }

        .agency-color-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 6px;
        }

        .agency-content {
            padding: 30px;
        }

        .agency-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .agency-location {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .agency-description {
            font-size: 1rem;
            color: #374151;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .agency-services {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .service-tag {
            background: #f3f4f6;
            color: #374151;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .stats-section {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 60px;
            text-align: center;
            margin-top: 80px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: white;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            color: #93c5fd;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .agencies-section {
                padding: 100px 30px 60px;
            }

            .agencies-title {
                font-size: 3rem;
            }

            .agencies-subtitle {
                font-size: 1.2rem;
            }

            .agencies-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .stats-section {
                padding: 40px 30px;
            }
        }

        @media (max-width: 480px) {
            .agencies-section {
                padding: 80px 20px 40px;
            }

            .agencies-title {
                font-size: 2.5rem;
            }

            .agency-content {
                padding: 20px;
            }
        }
</style>
@endsection

@section('content')
<!-- Section Our Agencies -->
<section class="agencies-section">
    <div class="agencies-container">
        <h1 class="agencies-title">Our Agencies</h1>
        <p class="agencies-subtitle">Strategic partners across Africa driving digital transformation</p>

        <div class="agencies-grid">
            @foreach($agenciesData as $agency)
            <div class="agency-card">
                <div class="agency-image">
                    <img src="{{ asset($agency->image) }}" alt="{{ $agency->name }}">
                    <div class="agency-color-bar" style="background: {{ $agency->color }}"></div>
                </div>
                <div class="agency-content">
                    <h3 class="agency-name">{{ $agency->name }}</h3>
                    <p class="agency-location">{{ $agency->location }}</p>
                    <p class="agency-description">{{ $agency->description }}</p>
                    <div class="agency-services">
                        @foreach($agency->services as $service)
                        <span class="service-tag">{{ $service }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">6</div>
                    <div class="stat-label">Agencies</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Countries</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Projects</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Team Members</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Animation des cartes au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observer toutes les cartes
    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.agency-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
            observer.observe(card);
        });

        // Animation des stats
        const stats = document.querySelectorAll('.stat-number');
        stats.forEach(stat => {
            const finalNumber = parseInt(stat.textContent);
            let currentNumber = 0;
            const increment = finalNumber / 50;
            const timer = setInterval(() => {
                currentNumber += increment;
                if (currentNumber >= finalNumber) {
                    stat.textContent = finalNumber + (stat.textContent.includes('+') ? '+' : '');
                    clearInterval(timer);
                } else {
                    stat.textContent = Math.floor(currentNumber) + (stat.textContent.includes('+') ? '+' : '');
                }
            }, 30);
        });
    });
</script>
@endsection
