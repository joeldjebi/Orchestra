@extends('layouts.app')

@section('title', 'Orchestra - Accueil')

@section('styles')
<style>
        .carousel-container {
            height: 100vh;
            overflow: hidden;
        }

        .carousel-slide {
            height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }

        .slide-content {
            display: flex;
            height: 100%;
            width: 100%;
        }

        .text-panel {
            background: white;
            flex: 0 0 45%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            position: relative;
        }

        .image-panel {
            flex: 0 0 55%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .image-panel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .main-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e3a8a;
            line-height: 1.2;
            margin-bottom: 30px;
        }

        .items-list {
            list-style: none;
            padding: 0;
            margin-bottom: 40px;
        }

        .items-list li {
            color: #6b7280;
            font-size: 1.1rem;
            margin-bottom: 8px;
            position: relative;
            padding-left: 20px;
        }

        .items-list li::before {
            content: "-";
            position: absolute;
            left: 0;
            color: #6b7280;
        }

        .learn-more {
            color: #1e3a8a;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .learn-more:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .hamburger-menu {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .hamburger-menu span {
            display: block;
            width: 20px;
            height: 2px;
            background: #333;
            margin: 3px 0;
            transition: all 0.3s ease;
        }

        .hamburger-menu.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger-menu.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger-menu.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        .carousel-controls {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .carousel-dot.active {
            background: white;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.8);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: background 0.3s ease;
        }

        .carousel-nav:hover {
            background: rgba(255, 255, 255, 1);
        }

        .carousel-nav.prev {
            left: 30px;
        }

        .carousel-nav.next {
            right: 30px;
        }

        .carousel-slide {
            display: none;
        }

        .carousel-slide.active {
            display: flex;
        }

        @media (max-width: 768px) {
            .slide-content {
                flex-direction: column;
            }

            .text-panel,
            .image-panel {
                flex: 1;
            }

            .text-panel {
                padding: 30px;
            }

            .main-title {
                font-size: 2rem;
            }
        }

        /* Section Leadership */
        .leadership-section {
            background: #1e3a8a;
            padding: 80px 0;
            color: white;
            position: relative;
        }

        .leadership-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .leadership-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .leadership-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }

        .leadership-subtitle {
            font-size: 1.2rem;
            color: #93c5fd;
            font-weight: 300;
        }

        .leadership-carousel {
            position: relative;
            overflow: hidden;
        }

        .leadership-slides {
            display: flex;
            transition: transform 0.5s ease;
            gap: 20px;
        }

        .leadership-slide {
            min-width: calc(25% - 15px);
            flex-shrink: 0;
        }

        .leadership-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .leadership-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .leadership-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            padding: 30px 20px 20px;
            color: white;
        }

        .leadership-name {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .leadership-position {
            font-size: 0.9rem;
            color: #e5e7eb;
        }

        .leadership-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #1e3a8a;
            font-size: 1.5rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .leadership-nav:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .leadership-nav.prev {
            left: 20px;
        }

        .leadership-nav.next {
            right: 20px;
        }

        .leadership-dots {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            gap: 10px;
        }

        .leadership-dot {
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .leadership-dot.active {
            background: white;
            border-color: white;
            transform: scale(1.2);
        }

        .board-section {
            margin-top: 60px;
            text-align: center;
        }

        .board-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: white;
        }

        .board-progress {
            width: 200px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        .board-progress::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 60px;
            height: 100%;
            background: white;
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .leadership-title {
                font-size: 2rem;
            }

            .leadership-slide {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .leadership-nav {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .leadership-slide {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }

        /* Section Footer/Contact */
        .footer-section {
            background: white;
            min-height: 100vh;
            display: flex;
        }

        .footer-container {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        .footer-content {
            flex: 1;
            background: white;
            padding: 80px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .footer-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .footer-subtitle {
            font-size: 2.2rem;
            font-weight: 600;
            color: #000;
            margin-bottom: 50px;
        }

        .contact-info {
            margin-bottom: 50px;
        }

        .contact-item {
            margin-bottom: 25px;
            font-size: 1.2rem;
            color: #333;
            line-height: 1.5;
        }

        .contact-item strong {
            color: #000;
            font-weight: 600;
        }

        .office-hours {
            margin-top: 50px;
        }

        .office-hours h3 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #000;
            margin-bottom: 25px;
        }

        .hours-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .hours-list li {
            margin-bottom: 15px;
            font-size: 1.1rem;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hours-list li strong {
            color: #000;
            font-weight: 600;
        }

        .footer-image {
            flex: 1;
            background: #87CEEB;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .footer-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
            }

            .footer-content {
                padding: 40px 30px;
            }

            .footer-title {
                font-size: 2.5rem;
            }

            .footer-subtitle {
                font-size: 1.8rem;
            }

            .footer-image {
                height: 400px;
            }
        }
</style>
@endsection

@section('content')
<div class="carousel-container">
    @foreach($carouselData as $index => $slide)
    <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
        <div class="slide-content">
            <!-- Panneau de texte -->
            <div class="text-panel">
                <h1 class="main-title">{{ $slide->title }}</h1>
                <ul class="items-list">
                    @foreach($slide->items as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
                <a href="#" class="learn-more">En savoir plus</a>
            </div>

            <!-- Panneau d'image -->
            <div class="image-panel">
                <img src="{{ asset($slide->image) }}" alt="{{ $slide->alt }}">
            </div>
        </div>
    </div>
    @endforeach

    <!-- Contrôles de navigation -->
    <button class="carousel-nav prev" onclick="changeSlide(-1)">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button class="carousel-nav next" onclick="changeSlide(1)">
        <i class="fas fa-chevron-right"></i>
    </button>

    <!-- Indicateurs -->
    <div class="carousel-controls">
        @foreach($carouselData as $index => $slide)
        <div class="carousel-dot {{ $index === 0 ? 'active' : '' }}" onclick="currentSlide({{ $index + 1 }})"></div>
        @endforeach
    </div>
</div>

<!-- Section Leadership -->
<section class="leadership-section" id="values">
    <div class="leadership-container">
        <div class="leadership-header">
            <h2 class="leadership-title">Leadership</h2>
            <p class="leadership-subtitle">A versatile team of decision makers</p>
        </div>

        <div class="leadership-carousel">
            <div class="leadership-slides" id="leadershipSlides">
                @foreach($leadershipData as $member)
                <div class="leadership-slide">
                    <div class="leadership-card">
                        <img src="{{ asset($member->image) }}" alt="{{ $member->name }}">
                        <div class="leadership-info">
                            <div class="leadership-name">{{ $member->name }}</div>
                            <div class="leadership-position">{{ $member->position }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <button class="leadership-nav prev" onclick="changeLeadershipSlide(-1)">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="leadership-nav next" onclick="changeLeadershipSlide(1)">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="leadership-dots">
            @for($i = 0; $i < count($leadershipData) - 3; $i++)
            <div class="leadership-dot {{ $i === 0 ? 'active' : '' }}" onclick="currentLeadershipSlide({{ $i + 1 }})"></div>
            @endfor
        </div>

            <div class="board-section" id="agencies">
                <h3 class="board-title">Board of Directors</h3>
                <div class="board-progress"></div>
            </div>
    </div>
</section>

<!-- Section Footer/Contact -->
<section class="footer-section" id="contacts">
    <div class="footer-container">
        <!-- Contenu de contact -->
        <div class="footer-content">
            <h2 class="footer-title">{{ $contactData->title ?? 'Contact Us' }}</h2>
            <h3 class="footer-subtitle">{{ $contactData->title ?? 'Contact Us' }}</h3>

            <div class="contact-info">
                <div class="contact-item">
                    {{ $contactData->address ?? '123 Innovation Drive, Tech Park, City, State, Zip Code' }}
                </div>
                <div class="contact-item">
                    <strong>Phone:</strong> {{ $contactData->phone ?? '(123) 456 7890' }}
                </div>
                <div class="contact-item">
                    <strong>Email:</strong> {{ $contactData->email ?? 'contact@orchestra.com' }}
                </div>
            </div>

            <div class="office-hours">
                <h3>Office Hours</h3>
                <ul class="hours-list">
                    @if($contactData && $contactData->office_hours)
                        @foreach($contactData->office_hours as $day => $hours)
                        <li>
                            <strong>{{ $day }}:</strong>
                            <span>{{ $hours }}</span>
                        </li>
                        @endforeach
                    @else
                        <li><strong>Monday - Friday:</strong> <span>9:00 AM - 5:00 PM</span></li>
                        <li><strong>Saturday:</strong> <span>10:00 AM - 2:00 PM</span></li>
                        <li><strong>Sunday:</strong> <span>Closed</span></li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Image -->
        <div class="footer-image">
            <img src="{{ $contactData && $contactData->image ? asset($contactData->image) : 'https://picsum.photos/800/600?random=1' }}" alt="Contact Us">
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    let currentSlideIndex = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const totalSlides = slides.length;

    function showSlide(index) {
        // Masquer toutes les diapositives
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        // Afficher la diapositive actuelle
        slides[index].classList.add('active');
        dots[index].classList.add('active');
    }

    function changeSlide(direction) {
        currentSlideIndex += direction;

        if (currentSlideIndex >= totalSlides) {
            currentSlideIndex = 0;
        } else if (currentSlideIndex < 0) {
            currentSlideIndex = totalSlides - 1;
        }

        showSlide(currentSlideIndex);
    }

    function currentSlide(index) {
        currentSlideIndex = index - 1;
        showSlide(currentSlideIndex);
    }

    // Auto-play du carousel (optionnel)
    setInterval(() => {
        changeSlide(1);
    }, 5000);

    // Navigation au clavier
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            changeSlide(-1);
        } else if (e.key === 'ArrowRight') {
            changeSlide(1);
        }
    });

    // Leadership Carousel - Défilement 1 élément à la fois avec 4 visibles
    const leadershipSlides = document.querySelectorAll('.leadership-slide');
    const leadershipDots = document.querySelectorAll('.leadership-dot');
    const totalLeadershipSlides = leadershipSlides.length;
    const maxPositions = totalLeadershipSlides - 3; // Nombre de positions possibles
    let currentLeadershipIndex = 0;

    function showLeadershipSlide(index) {
        const slidesContainer = document.getElementById('leadershipSlides');
        // Chaque élément fait 25% de largeur, donc on translate de 25% par élément
        const translateX = -index * 25;
        slidesContainer.style.transform = `translateX(${translateX}%)`;

        // Mettre à jour les dots (correspondent aux positions, pas aux éléments)
        leadershipDots.forEach(dot => dot.classList.remove('active'));
        if (leadershipDots[index]) {
            leadershipDots[index].classList.add('active');
        }

        // Gérer l'état des boutons de navigation
        const prevBtn = document.querySelector('.leadership-nav.prev');
        const nextBtn = document.querySelector('.leadership-nav.next');

        if (prevBtn) {
            prevBtn.style.opacity = index === 0 ? '0.5' : '1';
            prevBtn.style.cursor = index === 0 ? 'not-allowed' : 'pointer';
        }

        if (nextBtn) {
            nextBtn.style.opacity = index >= maxPositions - 1 ? '0.5' : '1';
            nextBtn.style.cursor = index >= maxPositions - 1 ? 'not-allowed' : 'pointer';
        }
    }

    function changeLeadershipSlide(direction) {
        currentLeadershipIndex += direction;

        // Limiter aux positions possibles (0 à maxPositions-1)
        if (currentLeadershipIndex < 0) {
            currentLeadershipIndex = 0;
        } else if (currentLeadershipIndex >= maxPositions) {
            currentLeadershipIndex = maxPositions - 1;
        }

        showLeadershipSlide(currentLeadershipIndex);
    }

    function currentLeadershipSlide(index) {
        currentLeadershipIndex = index - 1;

        // S'assurer que l'index est dans les limites des positions possibles
        if (currentLeadershipIndex < 0) {
            currentLeadershipIndex = 0;
        } else if (currentLeadershipIndex >= maxPositions) {
            currentLeadershipIndex = maxPositions - 1;
        }

        showLeadershipSlide(currentLeadershipIndex);
    }

    // Initialiser l'état des boutons
    showLeadershipSlide(currentLeadershipIndex);

    // Auto-play du carousel Leadership
    setInterval(() => {
        changeLeadershipSlide(1);
    }, 4000);
</script>
@endsection
