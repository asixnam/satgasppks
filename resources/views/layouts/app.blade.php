<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SATGAS PPKS UNU Yogyakarta</title>
    
    <!-- Meta Tags -->
    <meta name="description" content="Satuan Tugas Pencegahan dan Penanganan Kekerasan Seksual UNU Yogyakarta">
    <meta name="keywords" content="SATGAS, PPKS, UNU, Yogyakarta, Kekerasan Seksual">
    <meta name="author" content="SATGAS PPKS UNU Yogyakarta">
    
    <!-- Open Graph -->
    <meta property="og:title" content="SATGAS PPKS UNU Yogyakarta">
    <meta property="og:description" content="Satuan Tugas Pencegahan dan Penanganan Kekerasan Seksual UNU Yogyakarta">
    <meta property="og:type" content="website">
    
    <!-- Icons & Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')

    
    <!-- Tailwind CSS -->
    
    <!-- <script>
        tailwind.config = {
            theme: {
                extend: {
                    screens: {
                        'xs': '475px',
                    },
                    fontFamily: {
                        'inter': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script> -->
    
    <style>
        /* Custom CSS untuk efek yang tidak bisa dicapai dengan Tailwind saja */
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        .navbar-gradient {
            background: linear-gradient(135deg, #00272B 0%, #065f46 100%);
        }
        
        .navbar-scrolled {
            background: linear-gradient(135deg, rgba(0, 39, 43, 0.95) 0%, rgba(6, 95, 70, 0.95) 100%);
            backdrop-filter: blur(20px);
        }
        
        .footer-gradient {
            background: linear-gradient(135deg, #065f46 0%,  #00272B 100%);
        }
        
        .mobile-menu-gradient {
            background: linear-gradient(180deg, rgba(6, 95, 70, 0.98) 0%, rgba(20, 141, 115, 0.95) 100%);
            backdrop-filter: blur(20px);
        }
        
        .badge-pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .glass-effect {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Prevent iOS zoom on input focus */
        input, select, textarea {
            font-size: 16px;
        }
        
        /* Responsive text utilities */
        @media (max-width: 475px) {
            .text-responsive-xs {
                font-size: 0.75rem;
                line-height: 1rem;
            }
        }
        
        /* Better mobile menu positioning */
        @media (max-width: 640px) {
            #mobile-menu {
                max-width: calc(100vw - 2rem);
            }
        }
        
        /* Improved focus states for accessibility */
        .focus-visible:focus-visible {
            outline: 2px solid #fbbf24;
            outline-offset: 2px;
        }
        
        /* Custom scrollbar for mobile menu */
        #mobile-menu::-webkit-scrollbar {
            width: 4px;
        }
        
        #mobile-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        
        #mobile-menu::-webkit-scrollbar-thumb {
            background: rgba(251, 191, 36, 0.5);
            border-radius: 2px;
        }
        
        /* Touch target improvements */
        @media (pointer: coarse) {
            .touch-target {
                min-height: 44px;
                min-width: 44px;
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-inter overflow-x-hidden">
    
    <!-- Header Component -->
    @include('components.HeaderApp')

    <!-- Main Content -->
    <main class="min-h-screen pt-14 sm:pt-16 md:pt-18 lg:pt-20">
        @yield('content')
    </main>

    <!-- Footer Component -->
    @include('components.FooterApp')

    <!-- JavaScript -->
    <script>
        // Mobile menu functionality with improved performance
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const navbar = document.getElementById('navbar');

        let isMenuOpen = false;

        function openMobileMenu() {
            if (isMenuOpen) return;
            
            isMenuOpen = true;
            mobileMenu.classList.remove('-translate-x-full');
            mobileOverlay.classList.remove('opacity-0', 'invisible');
            mobileMenuBtn.setAttribute('aria-expanded', 'true');
            document.body.classList.add('overflow-hidden');
            
            // Focus management for accessibility
            mobileMenuClose.focus();
        }

        function closeMobileMenu() {
            if (!isMenuOpen) return;
            
            isMenuOpen = false;
            mobileMenu.classList.add('-translate-x-full');
            mobileOverlay.classList.add('opacity-0', 'invisible');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('overflow-hidden');
            
            // Return focus to menu button
            mobileMenuBtn.focus();
        }

        // Event listeners with passive option for better performance
        mobileMenuBtn?.addEventListener('click', openMobileMenu);
        mobileMenuClose?.addEventListener('click', closeMobileMenu);
        mobileOverlay?.addEventListener('click', closeMobileMenu);

        // Close mobile menu when clicking on navigation links
        const mobileNavLinks = document.querySelectorAll('#mobile-menu nav a');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });

        // Optimized navbar scroll effect with throttling
        let ticking = false;
        
        function updateNavbar() {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
                navbar.classList.remove('navbar-gradient');
            } else {
                navbar.classList.remove('navbar-scrolled');
                navbar.classList.add('navbar-gradient');
            }
            ticking = false;
        }

        function requestNavbarUpdate() {
            if (!ticking) {
                requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestNavbarUpdate, { passive: true });

        // Close mobile menu on window resize with debouncing
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth >= 768 && isMenuOpen) {
                    closeMobileMenu();
                }
            }, 150);
        }, { passive: true });

        // Enhanced keyboard navigation support
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isMenuOpen) {
                closeMobileMenu();
            }
            
            // Tab trapping in mobile menu
            if (isMenuOpen && e.key === 'Tab') {
                const focusableElements = mobileMenu.querySelectorAll(
                    'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
                );
                const firstElement = focusableElements[0];
                const lastElement = focusableElements[focusableElements.length - 1];
                
                if (e.shiftKey) {
                    if (document.activeElement === firstElement) {
                        lastElement.focus();
                        e.preventDefault();
                    }
                } else {
                    if (document.activeElement === lastElement) {
                        firstElement.focus();
                        e.preventDefault();
                    }
                }
            }
        });

        // Improved touch handling for mobile devices
        if ('ontouchstart' in window) {
            let touchStartX = 0;
            let touchEndX = 0;
            
            document.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });
            
            document.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, { passive: true });
            
            function handleSwipe() {
                const swipeThreshold = 50;
                const swipeDistance = touchEndX - touchStartX;
                
                // Swipe right to open menu (when closed)
                if (swipeDistance > swipeThreshold && !isMenuOpen && touchStartX < 50) {
                    openMobileMenu();
                }
                
                // Swipe left to close menu (when open)
                if (swipeDistance < -swipeThreshold && isMenuOpen) {
                    closeMobileMenu();
                }
            }
        }

        // Preload critical resources
        function preloadCriticalResources() {
            const criticalImages = [
                '{{ asset("image/satgas-logo.png") }}'
            ];
            
            criticalImages.forEach(src => {
                const link = document.createElement('link');
                link.rel = 'preload';
                link.as = 'image';
                link.href = src;
                document.head.appendChild(link);
            });
        }

        // Initialize on DOM content loaded
        document.addEventListener('DOMContentLoaded', function() {
            preloadCriticalResources();
            
            // Add loading states
            document.body.classList.add('loaded');
            
            // Initialize any tooltips or other interactive elements
            const tooltipElements = document.querySelectorAll('[title]');
            tooltipElements.forEach(el => {
                el.addEventListener('mouseenter', function() {
                    // Add custom tooltip logic if needed
                });
            });
        });

        // Performance monitoring (optional)
        if ('performance' in window) {
            window.addEventListener('load', function() {
                setTimeout(function() {
                    const perfData = performance.getEntriesByType('navigation')[0];
                    if (perfData.loadEventEnd - perfData.navigationStart > 3000) {
                        console.warn('Page load time is over 3 seconds');
                    }
                }, 0);
            });
        }

        // Service Worker registration (optional for PWA features)
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                // Uncomment if you have a service worker
                // navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>
</body>
</html>