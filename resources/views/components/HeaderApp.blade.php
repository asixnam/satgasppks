<!-- Mobile Overlay -->
<div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-40 opacity-0 invisible transition-all duration-300" aria-hidden="true"></div>

<!-- Navigation -->
<nav class="navbar-gradient fixed top-0 left-0 right-0 z-50 transition-all duration-500" id="navbar" role="navigation" aria-label="Main navigation">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 xl:px-8">
        <div class="flex items-center justify-between h-14 sm:h-16 md:h-18 lg:h-20">
            
            <!-- Logo Section -->
            <div class="flex items-center space-x-2 sm:space-x-3 flex-shrink-0 min-w-0 logo-container">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 sm:space-x-3" aria-label="SATGAS PPKS UNU Yogyakarta Home">
                    <img src="{{ asset('image/satgas-logo.png') }}" alt="SATGAS PPKS Logo" class="h-7 sm:h-8 md:h-10 lg:h-12 w-auto object-contain flex-shrink-0 transition-all duration-300">
                    <div class="hidden xs:block min-w-0">
                        <h1 class="font-bold text-xs sm:text-sm md:text-base lg:text-lg leading-tight truncate nav-text">SATGAS PPKPT</h1>
                        <p class="text-xs md:text-sm font-medium opacity-90 truncate nav-text">UNU Yogyakarta</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1 xl:space-x-2">
                <a href="{{ route('home') }}" class="nav-link flex items-center space-x-1.5 xl:space-x-2 px-2.5 xl:px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 border border-transparent hover:border-opacity-30 nav-text {{ request()->routeIs('home') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Beranda">
                    <i class="fas fa-home text-sm nav-icon" aria-hidden="true"></i>
                    <span class="whitespace-nowrap">Beranda</span>
                </a>
                <a href="{{ route('lapor-kekerasan.create') }}" class="nav-link flex items-center space-x-1.5 xl:space-x-2 px-2.5 xl:px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 border border-transparent hover:border-opacity-30 nav-text {{ request()->routeIs('lapor-kekerasan.create') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Lapor Kasus">
                    <i class="fas fa-exclamation-triangle text-sm nav-icon" aria-hidden="true"></i>
                    <span class="whitespace-nowrap">Lapor Kasus</span>
                </a>
                <a href="{{ route('cek-status') }}" class="nav-link flex items-center space-x-1.5 xl:space-x-2 px-2.5 xl:px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 border border-transparent hover:border-opacity-30 nav-text {{ request()->routeIs('cek-status') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Cek Status">
                    <i class="fas fa-search text-sm nav-icon" aria-hidden="true"></i>
                    <span class="whitespace-nowrap">Cek Status</span>
                 </a>
                <a href="{{ route('berita') }}" class="nav-link flex items-center space-x-1.5 xl:space-x-2 px-2.5 xl:px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 border border-transparent hover:border-opacity-30 nav-text {{ request()->routeIs('berita') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Berita">
                    <i class="fas fa-newspaper text-sm nav-icon" aria-hidden="true"></i>
                    <span class="whitespace-nowrap">Berita</span>
                </a>
                <a href="{{ route('edukasi') }}" class="nav-link flex items-center space-x-1.5 xl:space-x-2 px-2.5 xl:px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 border border-transparent hover:border-opacity-30 nav-text {{ request()->routeIs('edukasi') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Edukasi">
                    <i class="fas fa-book-open text-sm nav-icon" aria-hidden="true"></i>
                    <span class="whitespace-nowrap">Edukasi</span>
                </a>
                <a href="{{ route('tentang-kami') }}" class="nav-link flex items-center space-x-1.5 xl:space-x-2 px-2.5 xl:px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 border border-transparent hover:border-opacity-30 nav-text {{ request()->routeIs('tentang-kami') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Tentang Kami">
                    <i class="fas fa-info-circle text-sm nav-icon" aria-hidden="true"></i>
                    <span class="whitespace-nowrap">Tentang</span>
                </a>
            </div>

            <!-- Tablet Navigation (md to lg) -->
            <div class="hidden md:flex lg:hidden items-center space-x-1">
                <a href="{{ route('home') }}" class="nav-link flex items-center justify-center w-10 h-10 rounded-lg transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 nav-text {{ request()->routeIs('home') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Beranda" title="Beranda">
                    <i class="fas fa-home nav-icon" aria-hidden="true"></i>
                </a>
                <a href="{{ route('lapor-kekerasan.create') }}" class="nav-link flex items-center justify-center w-10 h-10 rounded-lg transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 nav-text {{ request()->routeIs('lapor-kekerasan.create') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Lapor Kasus" title="Lapor Kasus">
                    <i class="fas fa-exclamation-triangle nav-icon" aria-hidden="true"></i>
                </a>
                <a href="{{ route('cek-status') }}" class="nav-link flex items-center justify-center w-10 h-10 rounded-lg transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 relative nav-text {{ request()->routeIs('cek-status') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Cek Status" title="Cek Status">
                    <i class="fas fa-search nav-icon" aria-hidden="true"></i>
                    <span class="absolute -top-1 -right-1 bg-gradient-to-r from-yellow-300 to-yellow-500 text-black text-xs font-semibold px-1 py-0.5 rounded-full badge-pulse">!</span>
                </a>
                <a href="{{ route('berita') }}" class="nav-link flex items-center justify-center w-10 h-10 rounded-lg transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 nav-text {{ request()->routeIs('berita') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Berita" title="Berita">
                    <i class="fas fa-newspaper nav-icon" aria-hidden="true"></i>
                </a>
                <a href="{{ route('edukasi') }}" class="nav-link flex items-center justify-center w-10 h-10 rounded-lg transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 nav-text {{ request()->routeIs('edukasi') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Edukasi" title="Edukasi">
                    <i class="fas fa-book-open nav-icon" aria-hidden="true"></i>
                </a>
                <a href="{{ route('tentang-kami') }}" class="nav-link flex items-center justify-center w-10 h-10 rounded-lg transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:-translate-y-0.5 nav-text {{ request()->routeIs('tentang-kami') ? 'bg-white bg-opacity-10' : '' }}" aria-label="Tentang Kami" title="Tentang Kami">
                    <i class="fas fa-info-circle nav-icon" aria-hidden="true"></i>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button 
                id="mobile-menu-btn" 
                class="md:hidden p-2.5 rounded-lg transition-all duration-300 hover:scale-105 glass-effect flex-shrink-0" 
                aria-label="Open mobile menu"
                aria-expanded="false"
                aria-controls="mobile-menu"
            >
                <i class="fas fa-bars text-sm nav-text" aria-hidden="true"></i>
            </button>
            
        </div>
    </div>
</nav>

<!-- Mobile Menu -->
<div 
    id="mobile-menu" 
    class="fixed top-0 left-0 w-full max-w-xs sm:max-w-sm h-full mobile-menu-gradient transform -translate-x-full transition-transform duration-500 ease-out z-50 overflow-y-auto rounded-r-3xl shadow-2xl"
    role="dialog"
    aria-modal="true"
    aria-labelledby="mobile-menu-title"
>
    <button 
        id="mobile-menu-close" 
        class="absolute top-3 right-3 sm:top-4 sm:right-4 bg-white bg-opacity-10 border border-white border-opacity-20 text-white p-2.5 rounded-full transition-all duration-300 hover:bg-opacity-20 hover:text-yellow-300 hover:scale-110 glass-effect"
        aria-label="Close mobile menu"
    >
        <i class="fas fa-times text-sm" aria-hidden="true"></i>
    </button>
    
    <div class="p-4 sm:p-6 text-center border-b border-white border-opacity-10">
        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-white bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-3 sm:mb-4 glass-effect border border-white border-opacity-20">
            <img src="{{ asset('image/logo-unu.png') }}" alt="SATGAS PPKS Logo" class="h-7 sm:h-8 md:h-10 lg:h-12 w-auto object-contain flex-shrink-0 transition-all duration-300">
        </div>
        <h2 id="mobile-menu-title" class="text-white text-lg sm:text-xl font-bold mb-1">SATGAS PPKPT</h2>
        <p class="text-white text-xs sm:text-sm font-medium opacity-80">UNU Yogyakarta</p>
    </div>
    
    <nav class="p-3 sm:p-4" role="navigation" aria-label="Mobile navigation">
        <a href="{{ route('home') }}" class="flex items-center p-3 sm:p-4 mb-1.5 sm:mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30 {{ request()->routeIs('home') ? 'bg-white bg-opacity-10 border-yellow-300 border-opacity-30' : '' }}">
            <i class="fas fa-home w-5 sm:w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
            <span class="font-medium text-sm sm:text-base">Beranda</span>
        </a>
        <a href="{{ route('lapor-kekerasan.create') }}" class="flex items-center p-3 sm:p-4 mb-1.5 sm:mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30 {{ request()->routeIs('lapor-kekerasan.create') ? 'bg-white bg-opacity-10 border-yellow-300 border-opacity-30' : '' }}">
            <i class="fas fa-exclamation-triangle w-5 sm:w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
            <span class="font-medium text-sm sm:text-base">Lapor Kasus</span>
        </a>
        <a href="{{ route('cek-status') }}" class="flex items-center p-3 sm:p-4 mb-1.5 sm:mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30 {{ request()->routeIs('cek-status') ? 'bg-white bg-opacity-10 border-yellow-300 border-opacity-30' : '' }}">
            <i class="fas fa-search w-5 sm:w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
            <span class="font-medium text-sm sm:text-base">Cek Status</span>
        </a>
        <a href="{{ route('berita') }}" class="flex items-center p-3 sm:p-4 mb-1.5 sm:mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30 {{ request()->routeIs('berita') ? 'bg-white bg-opacity-10 border-yellow-300 border-opacity-30' : '' }}">
            <i class="fas fa-newspaper w-5 sm:w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
            <span class="font-medium text-sm sm:text-base">Berita</span>
        </a>
        <a href="{{ route('edukasi') }}" class="flex items-center p-3 sm:p-4 mb-1.5 sm:mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30 {{ request()->routeIs('edukasi') ? 'bg-white bg-opacity-10 border-yellow-300 border-opacity-30' : '' }}">
            <i class="fas fa-book-open w-5 sm:w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
            <span class="font-medium text-sm sm:text-base">Edukasi</span>
        </a>
        <a href="{{ route('tentang-kami') }}" class="flex items-center p-3 sm:p-4 mb-1.5 sm:mb-2 rounded-xl text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 hover:translate-x-1 border border-transparent hover:border-yellow-300 hover:border-opacity-30 {{ request()->routeIs('tentang-kami') ? 'bg-white bg-opacity-10 border-yellow-300 border-opacity-30' : '' }}">
            <i class="fas fa-info-circle w-5 sm:w-6 text-center mr-3 text-yellow-300" aria-hidden="true"></i>
            <span class="font-medium text-sm sm:text-base">Tentang Kami</span>
        </a>
    </nav>
</div>