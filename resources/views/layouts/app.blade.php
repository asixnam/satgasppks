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
    
    <style>
        /* Custom CSS untuk efek yang tidak bisa dicapai dengan Tailwind saja */
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        .navbar-gradient {
            background: linear-gradient(135deg, #065f46 0%, #7c3aed 100%);
        }
        
        .navbar-scrolled {
            background: linear-gradient(135deg, rgba(6, 95, 70, 0.95) 0%, rgba(124, 58, 237, 0.95) 100%);
            backdrop-filter: blur(20px);
        }
        
        .footer-gradient {
            background: linear-gradient(135deg, #065f46 0%, #7c3aed 100%);
        }
        
        .mobile-menu-gradient {
            background: linear-gradient(180deg, rgba(6, 95, 70, 0.98) 0%, rgba(124, 58, 237, 0.95) 100%);
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
    </style>
</head>

<body class="bg-gray-50 font-inter overflow-x-hidden">
    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-40 opacity-0 invisible transition-all duration-300" aria-hidden="true"></div>

    <!-- Navigation -->
    <nav class="navbar-gradient fixed top-0 left-0 right-0 z-50 transition-all duration-300 shadow-lg border-b border-white border-opacity-10" id="navbar" role="navigation" aria-label="Main navigation">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">
                
                <!-- Logo Section -->
                <div class="flex items-center space-x-3 flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3" aria-label="SATGAS PPKS UNU Yogyakarta Home">
                        <img src="{{ asset('image/satgas-logo.png') }}" alt="SATGAS PPKS Logo" class="h-8 md:h-10 lg:h-12 w-auto object-contain">
                        <div class="hidden sm:block">
                            <h1 class="text-white font-bold text-sm md:text-base lg:text-lg leading-tight">SATGAS PPKS</h1>
                            <p class="text-yellow-300 text-xs md:text-sm font-medium opacity-90">UNU Yogyakarta</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-2 lg:space-x-4">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:text-yellow-300 hover:-translate-y-0.5 border border-transparent hover:border-yellow-300 hover:border-opacity-30" aria-label="Beranda">
                        <i class="fas fa-home text-yellow-300" aria-hidden="true"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="{{ route('lapor-kekerasan.create') }}" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:text-yellow-300 hover:-translate-y-0.5 border border-transparent hover:border-yellow-300 hover:border-opacity-30" aria-label="Lapor Kasus">
                        <i class="fas fa-exclamation-triangle text-yellow-300" aria-hidden="true"></i>
                        <span>Lapor Kasus</span>
                    </a>
                    <a href="{{ route('cek-status') }}" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:text-yellow-300 hover:-translate-y-0.5 border border-transparent hover:border-yellow-300 hover:border-opacity-30" aria-label="Cek Status">
                        <i class="fas fa-search text-yellow-300" aria-hidden="true"></i>
                        <span>Cek Status</span>
                        <span class="hidden lg:inline bg-gradient-to-r from-yellow-300 to-yellow-500 text-black text-xs font-semibold px-2 py-1 rounded-full ml-1 badge-pulse" aria-label="Segera hadir">Soon</span>
                    </a>
                    <a href="{{ route('berita') }}" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:text-yellow-300 hover:-translate-y-0.5 border border-transparent hover:border-yellow-300 hover:border-opacity-30" aria-label="Berita">
                        <i class="fas fa-newspaper text-yellow-300" aria-hidden="true"></i>
                        <span>Berita</span>
                    </a>
                    <a href="{{ route('edukasi') }}" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:text-yellow-300 hover:-translate-y-0.5 border border-transparent hover:border-yellow-300 hover:border-opacity-30" aria-label="Edukasi">
                        <i class="fas fa-book-open text-yellow-300" aria-hidden="true"></i>
                        <span>Edukasi</span>
                    </a>
                    <a href="{{ route('tentang-kami') }}" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:text-yellow-300 hover:-translate-y-0.5 border border-transparent hover:border-yellow-300 hover:border-opacity-30" aria-label="Tentang Kami">
                        <i class="fas fa-info-circle text-yellow-300" aria-hidden="true"></i>
                        <span>Tentang</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button 
                    id="mobile-menu-btn" 
                    class="md:hidden bg-white bg-opacity-10 border border-white border-opacity-20 text-white p-3 rounded-lg transition-all duration-300 hover:bg-opacity-20 hover:text-yellow-300 hover:scale-105 glass-effect" 
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
        class="fixed top-0 left-0 w-full max-w-sm h-full mobile-menu-gradient transform -translate-x-full transition-transform duration-500 ease-out z-50 overflow-y-auto rounded-r-3xl shadow-2xl"
        role="dialog"
        aria-modal="true"
        aria-labelledby="mobile-menu-title"
    >
        <button 
            id="mobile-menu-close" 
            class="absolute top-4 right-4 bg-white bg-opacity-10 border border-white border-opacity-20 text-white p-3 rounded-full transition-all duration-300 hover:bg-opacity-20 hover:text-yellow-300 hover:scale-110 glass-effect"
            aria-label="Close mobile menu"
        >
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
        
        <div class="p-6 text-center border-b border-white border-opacity-10">
            <div class="w-16 h-16 bg-white bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-4 glass-effect border border-white border-opacity-20">
                <i class="fas fa-shield-alt text-yellow-300 text-2xl" aria-hidden="true"></i>
            </div>
            <h2 id="mobile-menu-title" class="text-white text-xl font-bold mb-1">SATGAS PPKS</h2>
            <p class="text-white text-sm font-medium opacity-80">UNU Yogyakarta</p>
        </div>
        
        <nav class="p-4" role="navigation" aria-label="Mobile navigation">
            <a href="{{ route('home') }}" class="flex items-center p-4 mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30">
                <i class="fas fa-home w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
                <span class="font-medium">Beranda</span>
            </a>
            <a href="{{ route('lapor-kekerasan.create') }}" class="flex items-center p-4 mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30">
                <i class="fas fa-exclamation-triangle w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
                <span class="font-medium">Lapor Kasus</span>
            </a>
            <a href="{{ route('cek-status') }}" class="flex items-center p-4 mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30">
                <i class="fas fa-search w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
                <span class="font-medium">Cek Status</span>
                <span class="bg-gradient-to-r from-yellow-300 to-yellow-500 text-black text-xs font-semibold px-2 py-1 rounded-full ml-auto badge-pulse">Soon</span>
            </a>
            <a href="{{ route('berita') }}" class="flex items-center p-4 mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30">
                <i class="fas fa-newspaper w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
                <span class="font-medium">Berita</span>
            </a>
            <a href="{{ route('edukasi') }}" class="flex items-center p-4 mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30">
                <i class="fas fa-book-open w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
                <span class="font-medium">Edukasi</span>
            </a>
            <a href="{{ route('tentang-kami') }}" class="flex items-center p-4 mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30">
                <i class="fas fa-info-circle w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
                <span class="font-medium">Tentang Kami</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="min-h-screen pt-16 md:pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-gradient relative" role="contentinfo">
        <div class="absolute inset-0 bg-black opacity-15"></div>
        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 mb-8">
                
                <!-- Contact Information -->
                <div>
                    <h3 class="text-yellow-300 text-xl font-semibold mb-6 uppercase tracking-wide">Kontak Kami</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                        
                        <div class="bg-white bg-opacity-8 backdrop-blur-sm border border-white border-opacity-10 rounded-xl p-5 transition-all duration-300 hover:bg-opacity-15 hover:border-yellow-300 hover:border-opacity-40 hover:-translate-y-1 hover:shadow-xl">
                            <div class="flex items-start space-x-4">
                                <i class="fab fa-instagram text-yellow-300 text-xl mt-1 w-6 text-center flex-shrink-0" aria-hidden="true"></i>
                                <div class="flex-1 min-w-0">
                                    <p class="text-white font-semibold text-base mb-1">Instagram</p>
                                    <a href="https://www.instagram.com/satgasppks.unuyo" target="_blank" rel="noopener noreferrer" class="text-white text-sm hover:text-yellow-300 transition-colors duration-200 break-all">
                                        @satgasppks.unuyo
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white bg-opacity-8 backdrop-blur-sm border border-white border-opacity-10 rounded-xl p-5 transition-all duration-300 hover:bg-opacity-15 hover:border-yellow-300 hover:border-opacity-40 hover:-translate-y-1 hover:shadow-xl">
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-envelope text-yellow-300 text-xl mt-1 w-6 text-center flex-shrink-0" aria-hidden="true"></i>
                                <div class="flex-1 min-w-0">
                                    <p class="text-white font-semibold text-base mb-1">Email</p>
                                    <a href="mailto:satgasppks@unu-jogja.ac.id" class="text-white text-sm hover:text-yellow-300 transition-colors duration-200 break-all">
                                        satgasppks@unu-jogja.ac.id
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white bg-opacity-8 backdrop-blur-sm border border-white border-opacity-10 rounded-xl p-5 transition-all duration-300 hover:bg-opacity-15 hover:border-yellow-300 hover:border-opacity-40 hover:-translate-y-1 hover:shadow-xl">
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-phone text-yellow-300 text-xl mt-1 w-6 text-center flex-shrink-0" aria-hidden="true"></i>
                                <div class="flex-1 min-w-0">
                                    <p class="text-white font-semibold text-base mb-1">Telepon</p>
                                    <a href="https://wa.me/6281323596022" target="_blank" rel="noopener noreferrer" class="text-white text-sm hover:text-yellow-300 transition-colors duration-200">
                                        0813-2359-6022
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <h3 class="text-yellow-300 text-xl font-semibold mb-6 uppercase tracking-wide">Alamat</h3>
                    <div class="bg-white bg-opacity-8 backdrop-blur-sm border border-white border-opacity-10 rounded-xl p-5 transition-all duration-300 hover:bg-opacity-15 hover:border-yellow-300 hover:border-opacity-40 hover:-translate-y-1 hover:shadow-xl">
                        <div class="flex items-start space-x-4">
                            <i class="fas fa-map-marker-alt text-yellow-300 text-xl mt-1 w-6 text-center flex-shrink-0" aria-hidden="true"></i>
                            <div class="flex-1">
                                <a href="https://www.google.com/maps?9FvWyDk5Fdpjt9PN9" target="_blank" rel="noopener noreferrer" class="text-white text-base leading-relaxed hover:text-yellow-300 transition-colors duration-200 hover:underline">
                                    Universitas Nahdlatul Ulama Yogyakarta<br>
                                    Jl. Ringroad Barat, Dowangan, Banyuraden, Kec. Gamping,<br>
                                    Kabupaten Sleman, Daerah Istimewa Yogyakarta 55293
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="border-t border-white border-opacity-20 pt-8 text-center">
                <p class="text-white text-sm opacity-80 font-medium">© 2024 SATGAS PPKS UNU Yogyakarta. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const navbar = document.getElementById('navbar');

        function openMobileMenu() {
            mobileMenu.classList.remove('-translate-x-full');
            mobileOverlay.classList.remove('opacity-0', 'invisible');
            mobileMenuBtn.setAttribute('aria-expanded', 'true');
            document.body.classList.add('overflow-hidden');
        }

        function closeMobileMenu() {
            mobileMenu.classList.add('-translate-x-full');
            mobileOverlay.classList.add('opacity-0', 'invisible');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('overflow-hidden');
        }

        // Event listeners
        mobileMenuBtn.addEventListener('click', openMobileMenu);
        mobileMenuClose.addEventListener('click', closeMobileMenu);
        mobileOverlay.addEventListener('click', closeMobileMenu);

        // Close mobile menu when clicking on navigation links
        const mobileNavLinks = document.querySelectorAll('#mobile-menu nav a');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
                navbar.classList.remove('navbar-gradient');
            } else {
                navbar.classList.remove('navbar-scrolled');
                navbar.classList.add('navbar-gradient');
            }
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                closeMobileMenu();
            }
        });

        // Keyboard navigation support
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMobileMenu();
            }
        });
    </script>
</body>
</html>