@extends('layouts.app')

@section('title', 'Press - Orchestra')

@section('styles')
<style>
        body {
            background: white;
            color: #333;
        }

        /* Blog Section */
        .blog-section {
            min-height: 100vh;
            padding: 120px 60px 80px;
            background: white;
        }

        .blog-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 60px;
            position: relative;
        }

        .blog-container::before {
            content: '';
            position: absolute;
            left: calc(66.66% - 30px);
            top: 0;
            bottom: 0;
            width: 1px;
            background: #e5e7eb;
        }

        /* Layout avec titre à droite */
        .blog-container.right-layout {
            grid-template-columns: 1fr 2fr;
        }

        .blog-container.right-layout::before {
            left: calc(33.33% - 30px);
        }

        .blog-container.right-layout .blog-main {
            order: 2;
            padding-left: 40px;
            padding-right: 0;
        }

        .blog-container.right-layout .blog-sidebar {
            order: 1;
            padding-right: 40px;
            padding-left: 0;
        }

        .blog-main {
            padding-right: 40px;
        }

        .blog-label {
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 500;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .blog-headline {
            font-size: 2.5rem;
            font-weight: 700;
            color: #4A709B;
            line-height: 1.2;
            margin-bottom: 40px;
        }

        .blog-image {
            margin-bottom: 40px;
            text-align: center;
        }

        .blog-image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .blog-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .blog-paragraph {
            font-size: 1rem;
            line-height: 1.6;
            color: #374151;
            margin-bottom: 20px;
        }

        .blog-sidebar {
            padding-left: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .sidebar-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: #000;
            line-height: 1.1;
            letter-spacing: -1px;
            text-transform: uppercase;
        }

        .sidebar-title span {
            display: block;
        }

        .blog-footer {
            margin-top: 80px;
            padding: 40px 0;
            position: relative;
            background: #f8f9fa;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 60px;
            position: relative;
        }

        .footer-text {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #374151;
            max-width: 800px;
            position: relative;
            z-index: 2;
        }

        .footer-decoration {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 50%, #CD853F 100%);
            opacity: 0.1;
            z-index: 1;
        }

        .footer-decoration::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 20px;
            width: 60px;
            height: 40px;
            background: #8B4513;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            transform: rotate(-15deg);
        }

        .footer-decoration::after {
            content: '';
            position: absolute;
            top: -30px;
            right: 30px;
            width: 80px;
            height: 50px;
            background: #D2691E;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            transform: rotate(25deg);
        }

        @media (max-width: 1024px) {
            .blog-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .blog-container::before {
                display: none;
            }

            .blog-main {
                padding-right: 0;
            }

            .blog-sidebar {
                padding-left: 0;
                padding-top: 40px;
                border-top: 1px solid #e5e7eb;
            }

            .blog-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .blog-section {
                padding: 100px 30px 60px;
            }

            .blog-headline {
                font-size: 2rem;
                margin-bottom: 30px;
            }

            .sidebar-title {
                font-size: 2rem;
            }

            .footer-content {
                padding: 0 30px;
            }
        }

        @media (max-width: 480px) {
            .blog-section {
                padding: 80px 20px 40px;
            }

            .blog-headline {
                font-size: 1.8rem;
            }

            .sidebar-title {
                font-size: 1.5rem;
            }
        }
</style>
@endsection

@section('content')
@foreach($blogData as $index => $article)
<!-- Section Blog/Press -->
<section class="blog-section">
    <div class="blog-container {{ $article->layout === 'right' ? 'right-layout' : '' }}">
        <!-- Contenu principal -->
        <div class="blog-main">
            <div class="blog-label">{{ $article->title }}</div>
            <h1 class="blog-headline">{{ $article->headline }}</h1>

            @if($article->image)
            <div class="blog-image">
                <img src="{{ asset($article->image) }}" alt="{{ $article->title }}">
            </div>
            @endif

            <div class="blog-content">
                <div class="blog-column">
                    <p class="blog-paragraph">{{ $article->content['paragraph1'] }}</p>
                    <p class="blog-paragraph">{{ $article->content['paragraph2'] }}</p>
                    <p class="blog-paragraph">{{ $article->content['paragraph3'] }}</p>
                </div>
                <div class="blog-column">
                    <p class="blog-paragraph">{{ $article->content['paragraph4'] }}</p>
                    <p class="blog-paragraph">{{ $article->content['paragraph5'] }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="blog-sidebar">
            <div class="sidebar-title">
                @php
                    $words = explode(' ', $article->sidebar_title);
                @endphp
                @foreach($words as $word)
                <span>{{ $word }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endforeach

<!-- Footer -->
<section class="blog-footer">
    <div class="footer-decoration"></div>
    <div class="footer-content">
        <p class="footer-text">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Animation du contenu au scroll
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

    // Observer les éléments
    document.addEventListener('DOMContentLoaded', () => {
        const elements = document.querySelectorAll('.blog-headline, .blog-paragraph, .sidebar-title');
        elements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
            observer.observe(element);
        });
    });
</script>
@endsection
