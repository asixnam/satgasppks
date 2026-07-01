@extends('layouts.app')

@section('content')
    {{-- Tampilan Hero --}}
    @include('Frontend.Pages.hero.hero')
    
    <!-- Latest konten -->
    <section class="py-16 bg-black-50">
         @include('Frontend.Pages.konten.index')
    </section>

    <!-- Latest News -->
    <section class="py-16 bg-gray-50">
         @include('Frontend.Pages.articel.articel')
    </section>

    <!-- Education Materials -->
    <section class="py-16 bg-white">
        @include('Frontend.Pages.edu.education')
    </section>
@endsection

@push('styles')
    <style>
        /* Custom styles khusus untuk halaman home */
        .hero-section {
            background: linear-gradient(135deg, #000000ff 0%, #8B5CF6 100%);
        }
        .konten-section{
            background-color: #ffffffff;
        }
        
        .news-section {
            background-color: #ffffffff;
        }
        
        .education-section {
            background-color: #ffffff;
        }
        
        /* Animasi untuk section transitions */
        .section-fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }
        
        .section-fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Card hover effects untuk artikel dan edukasi */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Responsive image optimization */
        .responsive-img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .responsive-img:hover {
            transform: scale(1.05);
        }
        
        /* Loading animation */
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* Custom button styles */
        .btn-primary-gradient {
            background: linear-gradient(45deg, #00492C, #8B5CF6);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 73, 44, 0.3);
            color: white;
            text-decoration: none;
        }
        
        /* Section dividers */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            margin: 2rem 0;
        }
        
        /* Typography improvements */
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .section-subtitle {
            font-size: 1.125rem;
            color: #6b7280;
            text-align: center;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Mobile optimizations */
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.5rem;
            }
            
            .section-subtitle {
                font-size: 1rem;
                margin-bottom: 2rem;
            }
            
            .card-hover:hover {
                transform: none;
            }
        }
        
        /* Performance optimizations */
        .gpu-accelerated {
            transform: translateZ(0);
            backface-visibility: hidden;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer untuk animasi fade-in
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);
            
            // Observe semua elemen dengan class section-fade-in
            document.querySelectorAll('.section-fade-in').forEach(el => {
                observer.observe(el);
            });
            
            // Lazy loading untuk gambar
            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('loading-skeleton');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
            
            // Smooth scroll untuk internal links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            // Performance monitoring
            if ('performance' in window) {
                window.addEventListener('load', function() {
                    setTimeout(function() {
                        const perfData = performance.getEntriesByType('navigation')[0];
                        console.log('Page load time:', perfData.loadEventEnd - perfData.fetchStart, 'ms');
                    }, 0);
                });
            }
            
            // Error handling untuk gambar yang gagal dimuat
            document.querySelectorAll('img').forEach(img => {
                img.addEventListener('error', function() {
                    this.src = '/images/placeholder.jpg'; // Fallback image
                    this.alt = 'Image not available';
                });
            });
            
            // Preload critical resources
            const preloadLinks = [
                '/css/critical.css',
                '/js/vendor.js'
            ];
            
            preloadLinks.forEach(href => {
                const link = document.createElement('link');
                link.rel = 'preload';
                link.href = href;
                link.as = href.endsWith('.css') ? 'style' : 'script';
                document.head.appendChild(link);
            });
        });
        
        // Service Worker registration untuk offline support
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js')
                    .then(function(registration) {
                        console.log('SW registered: ', registration);
                    })
                    .catch(function(registrationError) {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }
    </script>
@endpush