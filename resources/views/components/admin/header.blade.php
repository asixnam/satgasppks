<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header - SATGAS PPKS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .mobile-menu-gradient {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.95) 0%, rgba(30, 30, 30, 0.98) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        
        .nav-scroll {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        
        .nav-scroll::-webkit-scrollbar {
            display: none;
        }
        
        .dropdown-enter {
            animation: dropdownEnter 0.2s ease-out forwards;
        }
        
        .dropdown-exit {
            animation: dropdownExit 0.15s ease-in forwards;
        }
        
        @keyframes dropdownEnter {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        
        @keyframes dropdownExit {
            from {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
            to {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }
        }
        
        .mobile-menu-enter {
            animation: slideInLeft 0.3s ease-out forwards;
        }
        
        .mobile-menu-exit {
            animation: slideOutLeft 0.3s ease-in forwards;
        }
        
        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }
        
        @keyframes slideOutLeft {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }
        
        /* Custom scrollbar for mobile menu */
        .mobile-menu::-webkit-scrollbar {
            width: 4px;
        }
        
        .mobile-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .mobile-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }
        
        /* Active navigation item */
        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
        }
        
        /* Mobile menu item hover effects */
        .mobile-menu-item {
            position: relative;
            overflow: hidden;
        }
        
        .mobile-menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }
        
        .mobile-menu-item:hover::before {
            left: 100%;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-40 opacity-0 invisible transition-all duration-300" aria-hidden="true"></div>

    <header class="bg-black shadow-sm border-b border-gray-200 sticky top-0 z-50 text-white">
        <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 xl:px-8">
            <nav class="flex items-center justify-between h-14 sm:h-16">
                
                <!-- Logo and Title Section -->
                <div class="flex items-center space-x-2 sm:space-x-3 min-w-0 flex-shrink-0">
                    <a href="{{ route('admin.dashboard') }}" class="relative flex items-center space-x-2 sm:space-x-3">
                        <img src="{{ asset('/image/logoputih.png') }}" alt="SATGAS PPKS Logo" class="h-10 w-auto rounded shadow-lg">
                    </a>
                    <div class="hidden xs:block sm:block min-w-0">
                        <h1 class="font-bold text-xs sm:text-sm leading-tight truncate text-white">Admin SATGAS PPKPT</h1>
                        <p class="text-xs font-medium opacity-90 truncate text-white hidden sm:block">UNU Yogyakarta</p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex flex-1 justify-center max-w-4xl mx-8">
                    <div class="flex items-center space-x-1 overflow-x-auto nav-scroll pb-1">
                        <a href="{{ route('admin.dashboard') }}" class="nav-item active px-3 xl:px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition-all duration-200 hover:bg-white/10 hover:text-white">
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <a href="{{ route('admin.violence-reports.index') }}" class="nav-item px-3 xl:px-4 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/10 whitespace-nowrap transition-all duration-200">
                            <span class="nav-text">Laporan Kekerasan</span>
                        </a>
                        <a href="{{ route('admin.beritas.index') }}" class="nav-item px-3 xl:px-4 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/10 whitespace-nowrap transition-all duration-200">
                            <span class="nav-text">Berita</span>
                        </a>
                        <a href="{{ route('admin.edukasis.index') }}" class="nav-item px-3 xl:px-4 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/10 whitespace-nowrap transition-all duration-200">
                            <span class="nav-text">Edukasi</span>
                        </a>
                        <a href="{{ route('admin.visi-misi.index') }}" class="nav-item px-3 xl:px-4 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/10 whitespace-nowrap transition-all duration-200">
                            <span class="nav-text">Visi & Misi</span>
                        </a>
                        <a href="{{ route('admin.tims.index') }}" class="nav-item px-3 xl:px-4 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/10 whitespace-nowrap transition-all duration-200">
                            <span class="nav-text">Profile Tim</span>
                        </a>
                        <a href="{{ route('admin.hero.index') }}" class="nav-item px-3 xl:px-4 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/10 whitespace-nowrap transition-all duration-200">
                            <span class="nav-text">Sistem</span>
                        </a>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <!-- Mobile Menu Button -->
                    <button class="lg:hidden p-2 sm:p-3 rounded-xl hover:bg-white/10 transition-all duration-300 text-white" id="mobileMenuBtn" aria-label="Toggle mobile menu">
                        <i class="fas fa-bars text-lg sm:text-xl"></i>
                    </button>

                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <button id="userDropdownToggle" class="flex items-center space-x-2 sm:space-x-3 p-1.5 sm:p-2 rounded-xl hover:bg-white/10 transition-all duration-300 group" aria-label="User menu">
                            <div class="w-8 h-8 sm:w-10 sm:h-10  rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-300">
                                <i class="fas fa-user text-white-700 text-sm sm:text-lg"></i>
                            </div>
                            
                            <i class="fas fa-chevron-down text-xs sm:text-sm transition-transform duration-300 hidden sm:block" id="chevronIcon"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="absolute right-0 mt-2 w-48 sm:w-56 glass-effect rounded-xl shadow-xl py-2 z-[9999] hidden border border-white/20 dropdown-enter origin-top-right">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-900">{{ $user->name ?? 'Admin User' }}</p>
                                <p class="text-xs text-gray-500">{{ $user->email ?? 'admin@example.com' }}</p>
                            </div>
                            
                            
                            <div class="border-t border-gray-100 my-1"></div>
                                <a href="{{ route('logout') }}" class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt mr-3"></i>Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="fixed top-0 left-0 w-full max-w-xs sm:max-w-sm h-full mobile-menu-gradient transform -translate-x-full transition-transform duration-300 ease-out z-50 overflow-y-auto mobile-menu rounded-r-3xl shadow-2xl" role="dialog" aria-modal="true" aria-labelledby="mobile-menu-title">
            
            <!-- Mobile Menu Header -->
            <div class="flex items-center justify-between p-4 border-b border-white/10">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('/image/logoputih.png') }}" alt="SATGAS PPKS Logo" class="h-10 w-auto rounded shadow-lg">
                    <div>
                        <h2 id="mobile-menu-title" class="text-white font-bold text-sm">Admin SATGAS PPKPT</h2>
                        <p class="text-gray-300 text-xs">UNU Yogyakarta</p>
                    </div>
                </div>
                <button id="closeMobileMenu" class="p-2 rounded-lg hover:bg-white/10 transition-colors text-white" aria-label="Close menu">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            

            <!-- Mobile Navigation Links -->
            <nav class="py-4">
                <div class="space-y-1 px-4">
                    <a href="{{ route('admin.dashboard') }}" class="mobile-menu-item flex items-center px-3 py-3 rounded-lg text-white bg-white/15 font-medium transition-all duration-200">
                        <i class="fas fa-home mr-3 text-sm w-5"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.violence-reports.index') }}" class="mobile-menu-item flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200">
                        <i class="fas fa-exclamation-triangle mr-3 text-sm w-5"></i>Laporan Kekerasan
                    </a>
                    <a href="{{ route('admin.beritas.index') }}"  class="mobile-menu-item flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200">
                        <i class="fas fa-newspaper mr-3 text-sm w-5"></i>Berita
                    </a>
                    <a href="{{route('admin.edukasis.index') }}" class="mobile-menu-item flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200">
                        <i class="fas fa-graduation-cap mr-3 text-sm w-5"></i>Edukasi
                    </a>
                    <a href="{{route('admin.visi-misi.index') }}" class="mobile-menu-item flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200">
                        <i class="fas fa-eye mr-3 text-sm w-5"></i>Visi & Misi
                    </a>
                    <a href="{{route('admin.tims.index') }}" class="mobile-menu-item flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200">
                        <i class="fas fa-users mr-3 text-sm w-5"></i>Profile Tim
                    </a>
                    <a href="{{route('admin.hero.index') }}" class="mobile-menu-item flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200">
                        <i class="fas fa-cogs mr-3 text-sm w-5"></i>Sistem
                    </a>
                </div>

                <!-- Mobile Menu Footer -->
                <div class="mt-8 pt-4 border-t border-white/10 px-4">
                    <a href="{{ route('logout') }}" class="mobile-menu-item flex items-center px-3 py-3 rounded-lg text-red-400 hover:bg-red-900/20 transition-all duration-200"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">    
                            <i class="fas fa-sign-out-alt mr-3 text-sm w-5"></i>Keluar
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                         @csrf
                    </form>
                            
                </div>
            </nav>
        </div>
    </header>
    

    <!-- Demo Content -->
    

    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const closeMobileMenu = document.getElementById('closeMobileMenu');

        function openMobileMenu() {
            mobileMenu.classList.remove('-translate-x-full');
            mobileMenu.classList.add('mobile-menu-enter');
            mobileOverlay.classList.remove('opacity-0', 'invisible');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenuFunc() {
            mobileMenu.classList.add('-translate-x-full');
            mobileMenu.classList.remove('mobile-menu-enter');
            mobileOverlay.classList.add('opacity-0', 'invisible');
            document.body.style.overflow = '';
        }

        mobileMenuBtn.addEventListener('click', openMobileMenu);
        closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
        mobileOverlay.addEventListener('click', closeMobileMenuFunc);

        // User dropdown functionality
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');
        const chevronIcon = document.getElementById('chevronIcon');
        let isDropdownOpen = false;

        function toggleUserDropdown() {
            if (isDropdownOpen) {
                userDropdown.classList.remove('dropdown-enter');
                userDropdown.classList.add('dropdown-exit');
                setTimeout(() => {
                    userDropdown.classList.add('hidden');
                    userDropdown.classList.remove('dropdown-exit');
                }, 150);
                if (chevronIcon) chevronIcon.style.transform = 'rotate(0deg)';
                isDropdownOpen = false;
            } else {
                userDropdown.classList.remove('hidden');
                userDropdown.classList.add('dropdown-enter');
                if (chevronIcon) chevronIcon.style.transform = 'rotate(180deg)';
                isDropdownOpen = true;
            }
        }

        userDropdownToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleUserDropdown();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (isDropdownOpen && !userDropdown.contains(e.target) && !userDropdownToggle.contains(e.target)) {
                toggleUserDropdown();
            }
        });

        // Close mobile menu when clicking on navigation links
        const mobileNavLinks = mobileMenu.querySelectorAll('a[href]');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', () => {
                closeMobileMenuFunc();
            });
        });

        // Handle logout
        function handleLogout(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                console.log('Logout functionality would be implemented here');
                // In real implementation, you would submit the logout form or make an API call
            }
        }

        // Handle keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                if (isDropdownOpen) {
                    toggleUserDropdown();
                }
                if (!mobileMenu.classList.contains('-translate-x-full')) {
                    closeMobileMenuFunc();
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) { // lg breakpoint
                closeMobileMenuFunc();
            }
        });
    </script>
</body>
</html>