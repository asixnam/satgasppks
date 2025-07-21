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
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9f4',
                            100: '#dcf2e4',
                            200: '#bce4cd',
                            300: '#8cd0a8',
                            400: '#57b67c',
                            500: '#00492C',
                            600: '#004026',
                            700: '#003620',
                            800: '#002d1a',
                            900: '#002515'
                        },
                        secondary: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f'
                        },
                        accent: {
                            50: '#faf5ff',
                            100: '#f3e8ff',
                            200: '#e9d5ff',
                            300: '#d8b4fe',
                            400: '#c084fc',
                            500: '#8B5CF6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95'
                        }
                    },
                    screens: {
                        'xs': '320px',
                        'sm': '640px',
                        'md': '768px',
                        'lg': '1024px',
                        'xl': '1280px',
                        '2xl': '1536px',
                        '3xl': '1920px'
                    },
                    spacing: {
                        '18': '4.5rem',
                        '88': '22rem',
                        '128': '32rem'
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Base Styles */
        * {
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }
        
        html {
            scroll-behavior: smooth;
            -webkit-text-size-adjust: 100%;
        }
        
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }
        
        /* Prevent iOS zoom on input focus */
        input, select, textarea {
            font-size: 16px;
        }
        
        /* Navigation Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #00492C 0%, #8B5CF6 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .navbar.scrolled {
            background: linear-gradient(135deg, rgba(0, 73, 44, 0.95) 0%, rgba(139, 92, 246, 0.95) 100%);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        }
        
        .navbar-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .navbar-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 4rem;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }
        
        .logo-img {
            height: 2.5rem;
            width: auto;
            object-fit: contain;
        }
        
        .logo-text {
            font-size: 0.9rem;
            font-weight: 700;
            color: white;
            line-height: 1.2;
            letter-spacing: -0.025em;
        }
        
        .logo-subtitle {
            font-size: 0.75rem;
            opacity: 0.9;
            font-weight: 500;
        }
        
        /* Desktop Navigation */
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1rem;
            border-radius: 0.5rem;
            color: white;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            border: 1px solid transparent;
            white-space: nowrap;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(252, 211, 77, 0.3);
            color: #FCD34D;
            transform: translateY(-1px);
        }
        
        .nav-link.active {
            background: rgba(252, 211, 77, 0.15);
            border-color: rgba(252, 211, 77, 0.4);
            color: #FCD34D;
        }
        
        .nav-link i {
            font-size: 0.875rem;
            color: #FCD34D;
        }
        
        .badge {
            background: linear-gradient(45deg, #FCD34D, #F59E0B);
            color: #000;
            font-size: 0.625rem;
            font-weight: 600;
            padding: 0.125rem 0.375rem;
            border-radius: 9999px;
            margin-left: 0.25rem;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .mobile-menu-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #FCD34D;
            transform: scale(1.05);
        }
        
        /* Mobile Menu */
        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .mobile-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        
        .mobile-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 85%;
            max-width: 320px;
            height: 100vh;
            background: linear-gradient(180deg, rgba(0, 73, 44, 0.98) 0%, rgba(139, 92, 246, 0.95) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            transform: translateX(-100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            overflow-y: auto;
            border-radius: 0 1.5rem 1.5rem 0;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
        }
        
        .mobile-menu.show {
            transform: translateX(0);
        }
        
        .mobile-menu-header {
            padding: 1.5rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .mobile-menu-logo {
            width: 4rem;
            height: 4rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .mobile-menu-title {
            color: white;
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .mobile-menu-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .mobile-menu-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .mobile-menu-close:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #FCD34D;
            transform: scale(1.1);
        }
        
        .mobile-menu-nav {
            padding: 1rem;
        }
        
        .mobile-menu-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            margin: 0.25rem 0;
            border-radius: 0.75rem;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        
        .mobile-menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(252, 211, 77, 0.3);
            transform: translateX(0.25rem);
        }
        
        .mobile-menu-item i {
            width: 1.5rem;
            text-align: center;
            margin-right: 0.75rem;
            color: #FCD34D;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, #00492C 0%, #8B5CF6 100%);
            position: relative;
            margin-top: 2rem;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
        }
        
        .footer-content {
            position: relative;
            z-index: 10;
            max-width: 1440px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .contact-section {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .contact-item:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(252, 211, 77, 0.3);
            transform: translateY(-2px);
        }
        
        .contact-item i {
            color: #FCD34D;
            font-size: 1rem;
            margin-top: 0.125rem;
            flex-shrink: 0;
        }
        
        .contact-text {
            color: white;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 2rem;
            padding-top: 2rem;
            text-align: center;
        }
        
        .footer-bottom p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.875rem;
        }
        
        /* Responsive Design */
        
        /* Extra Small Devices (320px+) */
        @media (min-width: 320px) {
            .navbar-content {
                height: 3.5rem;
            }
            
            .logo-img {
                height: 2rem;
            }
            
            .logo-text {
                font-size: 0.8rem;
            }
            
            .mobile-menu-btn {
                display: block;
                padding: 0.5rem;
            }
            
            .nav-menu {
                display: none;
            }
            
            .mobile-menu {
                width: 100%;
                border-radius: 0;
            }
        }
        
        /* Small Devices (640px+) */
        @media (min-width: 640px) {
            .navbar-content {
                height: 4rem;
            }
            
            .logo-img {
                height: 2.25rem;
            }
            
            .logo-text {
                font-size: 0.875rem;
            }
            
            .mobile-menu {
                width: 85%;
                max-width: 320px;
                border-radius: 0 1.5rem 1.5rem 0;
            }
            
            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
            }
            
            .contact-section {
                grid-template-columns: 1fr;
            }
        }
        
        /* Medium Devices (768px+) */
        @media (min-width: 768px) {
            .navbar-content {
                height: 4.5rem;
            }
            
            .logo-img {
                height: 2.5rem;
            }
            
            .logo-text {
                font-size: 0.9rem;
            }
            
            .mobile-menu-btn {
                display: none;
            }
            
            .nav-menu {
                display: flex;
                gap: 0.5rem;
            }
            
            .nav-link {
                padding: 0.625rem 1rem;
                font-size: 0.875rem;
            }
            
            .footer-grid {
                grid-template-columns: 2fr 1fr;
                gap: 3rem;
            }
            
            .contact-section {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        /* Large Devices (1024px+) */
        @media (min-width: 1024px) {
            .navbar-content {
                height: 5rem;
            }
            
            .logo-img {
                height: 3rem;
            }
            
            .logo-text {
                font-size: 1rem;
            }
            
            .nav-menu {
                gap: 0.75rem;
            }
            
            .nav-link {
                padding: 0.75rem 1.25rem;
                font-size: 0.9rem;
            }
            
            .badge {
                display: inline-block;
            }
            
            .footer-grid {
                grid-template-columns: 2fr 1fr;
                gap: 4rem;
            }
            
            .contact-section {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        /* Extra Large Devices (1280px+) */
        @media (min-width: 1280px) {
            .navbar-container {
                padding: 0 2rem;
            }
            
            .logo-img {
                height: 3.25rem;
            }
            
            .logo-text {
                font-size: 1.1rem;
            }
            
            .nav-menu {
                gap: 1rem;
            }
            
            .nav-link {
                padding: 0.875rem 1.5rem;
                font-size: 0.95rem;
            }
            
            .footer-content {
                padding: 3rem 2rem;
            }
        }
        
        /* 2X Large Devices (1536px+) */
        @media (min-width: 1536px) {
            .navbar-container {
                padding: 0 3rem;
            }
            
            .logo-img {
                height: 3.5rem;
            }
            
            .logo-text {
                font-size: 1.125rem;
            }
            
            .nav-menu {
                gap: 1.25rem;
            }
            
            .nav-link {
                padding: 1rem 1.75rem;
                font-size: 1rem;
            }
            
            .footer-content {
                padding: 4rem 3rem;
            }
        }
        
        /* Touch Device Optimizations */
        @media (hover: none) and (pointer: coarse) {
            .nav-link,
            .mobile-menu-item,
            .contact-item {
                min-height: 44px;
            }
            
            .mobile-menu-btn {
                min-height: 44px;
                min-width: 44px;
            }
        }
        
        /* High DPI Displays */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .logo-img {
                image-rendering: -webkit-optimize-contrast;
                image-rendering: crisp-edges;
            }
        }
        
        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            .navbar {
                border-bottom-color: rgba(255, 255, 255, 0.15);
            }
            
            .mobile-menu {
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            }
        }
        
        /* Print Styles */
        @media print {
            .navbar,
            .mobile-menu,
            .mobile-overlay {
                display: none !important;
            }
            
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="mobile-overlay" aria-hidden="true"></div>

    <!-- Navigation -->
    <nav class="navbar" role="navigation" aria-label="Main navigation">
        <div class="navbar-container">
            <div class="navbar-content">
                
                <!-- Logo Section -->
                <div class="logo-container">
                    <a href="/" class="flex items-center" aria-label="SATGAS PPKS UNU Yogyakarta Home">
                        <img src="/image/satgas-logo.png" alt="SATGAS PPKS Logo" class="logo-img">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="nav-menu">
                    <a href="/" class="nav-link" aria-label="Beranda">
                        <i class="fas fa-home" aria-hidden="true"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="/lapor" class="nav-link" aria-label="Lapor Kasus">
                        <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                        <span>Lapor Kasus</span>
                    </a>
                    <a href="/cek-status" class="nav-link" aria-label="Cek Status">
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <span>Cek Status</span>
                        <span class="badge hidden lg:inline" aria-label="Segera hadir">Soon</span>
                    </a>
                    <a href="/berita" class="nav-link" aria-label="Berita">
                        <i class="fas fa-newspaper" aria-hidden="true"></i>
                        <span>Berita</span>
                    </a>
                    <a href="/edukasi" class="nav-link" aria-label="Edukasi">
                        <i class="fas fa-book-open" aria-hidden="true"></i>
                        <span>Edukasi</span>
                    </a>
                    <a href="/tentang-kami" class="nav-link" aria-label="Tentang Kami">
                        <i class="fas fa-info-circle" aria-hidden="true"></i>
                        <span>Tentang</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button 
                    id="mobile-menu-btn" 
                    class="mobile-menu-btn" 
                    aria-label="Open mobile menu"
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                >
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
                
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div 
        id="mobile-menu" 
        class="mobile-menu"
        role="dialog"
        aria-modal="true"
        aria-labelledby="mobile-menu-title"
    >
        <button 
            id="mobile-menu-close" 
            class="mobile-menu-close"
            aria-label="Close mobile menu"
        >
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
        
        <div class="mobile-menu-header">
            <div class="mobile-menu-logo">
                <i class="fas fa-shield-alt text-yellow-300 text-2xl" aria-hidden="true"></i>
            </div>
            <h2 id="mobile-menu-title" class="mobile-menu-title">SATGAS PPKS</h2>
            <p class="mobile-menu-subtitle">UNU Yogyakarta</p>
        </div>
        
        <nav class="mobile-menu-nav" role="navigation" aria-label="Mobile navigation">
            <a href="/" class="mobile-menu-item">
                <i class="fas fa-home" aria-hidden="true"></i>
                <span>Beranda</span>
            </a>
            <a href="/lapor" class="mobile-menu-item">
                <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                <span>Lapor Kasus</span>
            </a>
            <a href="/cek-status" class="mobile-menu-item">
                <i class="fas fa-search" aria-hidden="true"></i>
                <span>Cek Status</span>
                <span class="badge ml-auto">Soon</span>
            </a>
            <a href="/berita" class="mobile-menu-item">
                <i class="fas fa-newspaper" aria-hidden="true"></i>
                <span>Berita</span>
            </a>
            <a href="/edukasi" class="mobile-menu-item">
                <i class="fas fa-book-open" aria-hidden="true"></i>
                <span>Edukasi</span>
            </a>
            <a href="/tentang-kami" class="mobile-menu-item">
                <i class="fas fa-info-circle" aria-hidden="true"></i>
                <span>Tentang Kami</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="min-h-screen pt-16">
        <!-- Konten utama akan ditambahkan di sini -->
    </main>

    <!-- Footer -->
    <footer class="footer" role="contentinfo">
        <div class="footer-content">
            <div class="footer-grid">
                
                <!-- Contact Information -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Kontak Kami</h3>
                    <div class="contact-section">
                        <div class="contact-item">
                            <i class="fab fa-instagram" aria-hidden="true"></i>
                            <div class="contact-text">
                                <strong>Instagram</strong><br>
                                @satgasppks.unuyogya
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                            <div class="contact-text">
                                <strong>Email</strong><br>
                                satgasppks@unu-jogja.ac.id
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-phone" aria-hidden="true"></i>
                            <div class="contact-text">
                                <strong>Telepon</strong><br>
                                085156900844
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Alamat</h3>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                        <div class="contact-text">
                            Jl. Ringroad Barat, Dowangan, Banyuraden, Gamping, Sleman, Yogyakarta
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>© 2023 SATGAS PPKS UNU Yogyakarta. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Ambil elemen yang dibutuhkan
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const mobileMenuClose = document.getElementById('mobile-menu-close');

        // Fungsi untuk buka menu
        function openMobileMenu() {
            mobileMenu.classList.add('show');
            mobileOverlay.classList.add('show');
            mobileMenuBtn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        // Fungsi untuk tutup menu
        function closeMobileMenu() {
            mobileMenu.classList.remove('show');
            mobileOverlay.classList.remove('show');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        // Event listener tombol buka
        mobileMenuBtn.addEventListener('click', openMobileMenu);

        // Event listener tombol tutup
        mobileMenuClose.addEventListener('click', closeMobileMenu);

        // Tutup menu jika klik di luar (overlay)
        mobileOverlay.addEventListener('click', closeMobileMenu);

        // Tambahkan efek scroll untuk navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>