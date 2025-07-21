<header class="gradient-bg text-white shadow-xl relative overflow-hidden h-20 flex-shrink-0">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full -translate-y-32 translate-x-32"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white rounded-full translate-y-16 -translate-x-16"></div>
    </div>

    <div class="relative z-10 flex justify-between items-center px-6 py-4 h-full">
        <div class="flex items-center space-x-4">
            <a href="{{ url('/admin/dashboard') }}" class="relative block">
                <img src="{{ asset('/image/satgas-logo.png') }}" alt="SATGAS PPKS Logo" class="h-12 w-auto rounded shadow-lg">
            </a>
        </div>

        <div class="flex items-center space-x-3">
            <!-- Notifications -->
            <div class="relative">
                <button class="relative p-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                    <i class="fas fa-bell text-xl group-hover:scale-110 transition-transform duration-300"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-xs rounded-full h-6 w-6 flex items-center justify-center font-semibold notification-pulse shadow-lg">3</span>
                </button>
            </div>

            <!-- User Profile Dropdown -->
            @php $user = Auth::user(); @endphp
            <div class="relative">
                <button class="flex items-center space-x-3 p-2 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-user text-green-700 text-lg"></i>
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold">{{ $user->name ?? 'Admin' }}</p>
                        <p class="text-xs text-green-100">{{ $user->email ?? 'admin@example.com' }}</p>
                    </div>
                    <i class="fas fa-chevron-down text-sm group-hover:rotate-180 transition-transform duration-300"></i>
                </button>

                <!-- Dropdown Menu -->
                <div class="absolute right-0 mt-3 w-56 glass-effect rounded-xl shadow-xl py-2 z-50 hidden border border-white/20" id="userDropdown">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900">{{ $user->name ?? 'Admin User' }}</p>
                        <p class="text-xs text-gray-500">{{ $user->email ?? 'admin@example.com' }}</p>
                    </div>
                    <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors duration-200">
                        <i class="fas fa-user-circle mr-3 text-green-600"></i>Profile Saya
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors duration-200">
                        <i class="fas fa-cog mr-3 text-green-600"></i>Pengaturan
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors duration-200">
                        <i class="fas fa-question-circle mr-3 text-green-600"></i>Bantuan
                    </a>
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

            <!-- Mobile Menu Button -->
            <button class="md:hidden p-3 rounded-xl hover:bg-white/10 transition-all duration-300" id="mobileMenuBtn">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
</header>