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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/satgas-logo.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}"> 
<link rel="preconnect" href="https://fonts.googleapis.com">

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
        } -->
    </script>
    
   <style>
        /* Custom gradients and animations */
        .navbar-gradient {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.5s ease;
        }
        
        .navbar-gradient.scrolled {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
       .mobile-menu-gradient {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
                
        .glass-effect {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .badge-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Custom breakpoint for xs */
        @media (min-width: 475px) {
            .xs\:block { display: block; }
        }

        /* Smooth transitions for all elements */
        .navbar-gradient * {
            transition: all 0.3s ease;
        }

        /* Logo animation when scrolled */
        .navbar-gradient.scrolled .logo-container {
            transform: scale(0.95);
        }

        /* Text shadow for better readability when transparent */
        .navbar-gradient:not(.scrolled) .nav-text {
            color: #374151; /* gray-700 - dark color for better contrast */
            text-shadow: 0 2px 4px rgba(255, 255, 255, 0.3);
        }

        /* Text color when scrolled - dark color */
        .navbar-gradient.scrolled .nav-text {
            color: #1f2937; /* gray-800 - dark color */
            text-shadow: none;
        }

        /* Icon colors when transparent */
        .navbar-gradient:not(.scrolled) .nav-icon {
            color: #f59e0b; /* amber-500 */
        }

        /* Icon colors when scrolled - dark color */
        .navbar-gradient.scrolled .nav-icon {
            color: #374151; /* gray-700 */
        }

        /* Mobile button colors when transparent */
        .navbar-gradient:not(.scrolled) #mobile-menu-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #374151;
        }

        /* Mobile button colors when scrolled */
        .navbar-gradient.scrolled #mobile-menu-btn {
            background: rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #1f2937;
        }

        /* Hover effects for scrolled state */
        .navbar-gradient.scrolled .nav-link:hover {
            background: rgba(0, 0, 0, 0.1);
            color: #111827; /* gray-900 */
        }

        /* Hover effects for transparent state */
        .navbar-gradient:not(.scrolled) .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #1f2937;
        }

        /* Active state for scrolled navbar */
        .navbar-gradient.scrolled .nav-link.active {
            background: rgba(59, 130, 246, 0.1) !important; /* blue tint */
            color: #797979ff !important; /* blue-800 */
        }

        /* Active state for transparent navbar */
        .navbar-gradient:not(.scrolled) .nav-link.active {
            background: rgba(255, 255, 255, 0.2) !important;
            color: #1f2937 !important;
        }

        /* Hero section for demo */
        .hero-section {
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Demo content sections */
        .demo-section {
            min-height: 100vh;
            padding: 80px 0;
        }

        .demo-section:nth-child(even) {
            background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
        }

        .demo-section:nth-child(odd) {
            background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
        }

        footer {
            background-color: #191718;
            color: #fff;
        }
    </style>
</head>

<body class="bg-gray-50 font-inter overflow-x-hidden">
    
    <!-- Header Component -->
    @include('components.HeaderApp')

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer Component -->
    @include('components.FooterApp')

    <!-- JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
     <script src="https://cdn.tailwindcss.com"></script>

        <script>
            // Inisialisasi Swiper untuk Hero Section
            var swiper = new Swiper(".heroSwiper", {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                effect: "fade", // atau ganti "slide" kalau mau geser biasa
            });
        </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('navbar');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileOverlay = document.getElementById('mobile-overlay');

        // Sticky navbar with transparent effect
        function handleNavbarScroll() {
            const scrolled = window.pageYOffset > 50;
            
            if (scrolled) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        // Throttle scroll event for better performance
        let ticking = false;
        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(handleNavbarScroll);
                ticking = true;
            }
        }

        window.addEventListener('scroll', function() {
            ticking = false;
            requestTick();
        });

        // Mobile menu functionality
        function openMobileMenu() {
            mobileMenu.style.transform = 'translateX(0)';
            mobileOverlay.classList.remove('invisible', 'opacity-0');
            mobileOverlay.classList.add('opacity-100', 'visible');
            mobileMenuBtn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            mobileMenu.style.transform = 'translateX(-100%)';
            mobileOverlay.classList.add('invisible', 'opacity-0');
            mobileOverlay.classList.remove('opacity-100', 'visible');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        // Event listeners for mobile menu
        mobileMenuBtn.addEventListener('click', openMobileMenu);
        mobileMenuClose.addEventListener('click', closeMobileMenu);
        mobileOverlay.addEventListener('click', closeMobileMenu);

        // Close mobile menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.style.transform === 'translateX(0px)') {
                closeMobileMenu();
            }
        });

        // Close mobile menu when clicking on mobile menu links
        const mobileLinks = mobileMenu.querySelectorAll('nav a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });

        // Active link management
        const navLinks = document.querySelectorAll('.nav-link');
        
        function setActiveLink(targetId) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${targetId}`) {
                    link.classList.add('active');
                }
            });
        }

        // Handle navigation clicks
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    setActiveLink(targetId);
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Update active link on scroll
        const sections = document.querySelectorAll('section[id]');
        
        function updateActiveLink() {
            const scrollPos = window.pageYOffset + 100;
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionBottom = sectionTop + section.offsetHeight;
                
                if (scrollPos >= sectionTop && scrollPos < sectionBottom) {
                    setActiveLink(section.id);
                }
            });
        }

        window.addEventListener('scroll', updateActiveLink);

        // Initial calls
        handleNavbarScroll();
        updateActiveLink();
    });
    </script>
</body>
</html>