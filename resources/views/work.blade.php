@extends('layouts.app')

@section('title', 'Work - Orchestra')

@section('styles')
<style>
        /* Work Section */
        .work-section {
            min-height: 100vh;
            padding: 120px 60px 80px;
            background: #1e3a8a;
        }

        .work-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .work-title {
            font-size: 4rem;
            font-weight: 700;
            color: white;
            margin-bottom: 80px;
            line-height: 1.1;
        }

        .work-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }

        .work-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .work-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .work-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .work-card-label {
            padding: 20px;
            text-align: center;
            background: white;
            color: #1e3a8a;
            font-size: 1.3rem;
            font-weight: 600;
            border-top: 1px solid #e5e7eb;
        }

        @media (max-width: 1024px) {
            .work-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            .work-section {
                padding: 100px 30px 60px;
            }

            .work-title {
                font-size: 3rem;
                margin-bottom: 60px;
            }

            .work-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }
        }

        @media (max-width: 480px) {
            .work-section {
                padding: 80px 20px 40px;
            }

            .work-title {
                font-size: 2.5rem;
                margin-bottom: 40px;
            }
        }
</style>
@endsection

@section('content')
<!-- Section Work -->
<section class="work-section">
    <div class="work-container">
        <h1 class="work-title">Work</h1>

        <div class="work-grid">
            @foreach($workData as $project)
            <div class="work-card">
                <img src="{{ asset($project->image) }}" alt="{{ $project->client }}">
                <div class="work-card-label">{{ $project->client }}</div>
            </div>
            @endforeach
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
        const cards = document.querySelectorAll('.work-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
            observer.observe(card);
        });
    });
</script>
@endsection
