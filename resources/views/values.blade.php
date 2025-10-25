@extends('layouts.app')

@section('title', 'Our Values - Orchestra')

@section('styles')
<style>
        body {
            background: #1e3a8a;
            color: white;
        }

        /* Values Section */
        .values-section {
            min-height: 100vh;
            padding: 120px 60px 80px;
            background: #1e3a8a;
        }

        .values-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .values-title {
            font-size: 4rem;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            line-height: 1.1;
            text-align: center;
        }

        .values-subtitle {
            font-size: 1.5rem;
            color: #93c5fd;
            text-align: center;
            margin-bottom: 80px;
            font-weight: 300;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }

        .value-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .value-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
        }

        .value-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            display: block;
        }

        .value-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 15px;
        }

        .value-description {
            font-size: 1.1rem;
            color: #374151;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .value-details {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .value-details li {
            color: #6b7280;
            margin-bottom: 8px;
            position: relative;
            padding-left: 20px;
            font-size: 0.95rem;
        }

        .value-details li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #10b981;
            font-weight: bold;
        }

        /* Couleurs spécifiques pour chaque valeur */
        .value-card:nth-child(1)::before { background: #3b82f6; }
        .value-card:nth-child(1) .value-icon { color: #3b82f6; }

        .value-card:nth-child(2)::before { background: #f59e0b; }
        .value-card:nth-child(2) .value-icon { color: #f59e0b; }

        .value-card:nth-child(3)::before { background: #10b981; }
        .value-card:nth-child(3) .value-icon { color: #10b981; }

        .value-card:nth-child(4)::before { background: #8b5cf6; }
        .value-card:nth-child(4) .value-icon { color: #8b5cf6; }

        .value-card:nth-child(5)::before { background: #ef4444; }
        .value-card:nth-child(5) .value-icon { color: #ef4444; }

        .value-card:nth-child(6)::before { background: #06b6d4; }
        .value-card:nth-child(6) .value-icon { color: #06b6d4; }

        .mission-section {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 60px;
            text-align: center;
            margin-top: 80px;
        }

        .mission-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 30px;
        }

        .mission-text {
            font-size: 1.2rem;
            color: #93c5fd;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .values-section {
                padding: 100px 30px 60px;
            }

            .values-title {
                font-size: 3rem;
            }

            .values-subtitle {
                font-size: 1.2rem;
            }

            .values-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .value-card {
                padding: 30px;
            }

            .mission-section {
                padding: 40px 30px;
            }
        }

        @media (max-width: 480px) {
            .values-section {
                padding: 80px 20px 40px;
            }

            .values-title {
                font-size: 2.5rem;
            }

            .value-card {
                padding: 25px;
            }
        }
</style>
@endsection

@section('content')
<!-- Section Our Values -->
<section class="values-section">
    <div class="values-container">
        <h1 class="values-title">Our Values</h1>
        <p class="values-subtitle">The principles that guide everything we do</p>

        <div class="values-grid">
            @foreach($valuesData as $value)
            <div class="value-card">
                <i class="{{ $value->icon }} value-icon"></i>
                <h3 class="value-title">{{ $value->title }}</h3>
                <p class="value-description">{{ $value->description }}</p>
                <ul class="value-details">
                    @foreach($value->details as $detail)
                    <li>{{ $detail }}</li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>

        <!-- Mission Section -->
        <div class="mission-section">
            <h2 class="mission-title">Our Mission</h2>
            <p class="mission-text">
                We are committed to empowering African businesses through innovative technology solutions,
                fostering sustainable growth, and creating meaningful impact across the continent.
                Our values guide every decision we make and every relationship we build,
                ensuring we deliver excellence while making a positive difference in the communities we serve.
            </p>
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
        const cards = document.querySelectorAll('.value-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
            observer.observe(card);
        });

        // Animation de la section mission
        const missionSection = document.querySelector('.mission-section');
        if (missionSection) {
            missionSection.style.opacity = '0';
            missionSection.style.transform = 'translateY(30px)';
            missionSection.style.transition = 'opacity 0.8s ease 0.5s, transform 0.8s ease 0.5s';
            observer.observe(missionSection);
        }
    });
</script>
@endsection
