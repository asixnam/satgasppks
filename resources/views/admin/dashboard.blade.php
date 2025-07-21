<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SATGAS PPKS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Custom styles for enhanced appearance */
        .gradient-bg {
            background: linear-gradient(135deg, #065f46 0%, #047857 50%, #059669 100%);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .sidebar-shadow {
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
        }

        .nav-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item:hover {
            transform: translateX(4px);
        }

        .notification-pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .smooth-scroll {
            scroll-behavior: smooth;
        }

        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .active-nav {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border-left: 4px solid #10b981;
        }

        .footer-gradient {
            background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #047857 100%);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="flex flex-col h-screen">
        <!-- Enhanced Header -->
        <header class="gradient-bg text-white shadow-xl relative overflow-hidden">

            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full -translate-y-32 translate-x-32">
                </div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-white rounded-full translate-y-16 -translate-x-16">
                </div>
            </div>

            <div class="relative z-10 flex justify-between items-center px-6 py-4">

                <div class="flex items-center space-x-4">
                    <a href="{{ url('/admin/dashboard') }}" class="relative block">
                        <img src="/image/satgas-logo.png" alt="SATGAS PPKS Logo" class="w-[250px] rounded shadow-lg">
                    </a>
                </div>


                <div class="flex items-center space-x-3">

                    <div class="relative">
                        <button class="relative p-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                            <i class="fas fa-bell text-xl group-hover:scale-110 transition-transform duration-300"></i>
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-xs rounded-full h-6 w-6 flex items-center justify-center font-semibold notification-pulse shadow-lg">3</span>
                        </button>
                    </div>


                    <div class="relative">
                        <button
                            class="flex items-center space-x-3 p-2 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                            <div
                                class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-300">
                                <i class="fas fa-user text-green-700 text-lg"></i>
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-semibold">Admin</p>
                                <p class="text-xs text-green-100">Administrator</p>
                            </div>
                            <i
                                class="fas fa-chevron-down text-sm group-hover:rotate-180 transition-transform duration-300"></i>
                        </button>

                        <!-- Enhanced Dropdown Menu -->
                        <div class="absolute right-0 mt-3 w-56 glass-effect rounded-xl shadow-xl py-2 z-50 hidden border border-white/20"
                            id="userDropdown">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">Admin User</p>
                                <p class="text-xs text-gray-500">admin@unu-jogja.ac.id</p>
                            </div>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors duration-200">
                                <i class="fas fa-user-circle mr-3 text-green-600"></i>Profile Saya
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors duration-200">
                                <i class="fas fa-cog mr-3 text-green-600"></i>Pengaturan
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors duration-200">
                                <i class="fas fa-question-circle mr-3 text-green-600"></i>Bantuan
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                <i class="fas fa-sign-out-alt mr-3"></i>Keluar
                            </a>
                        </div>
                    </div>

                    <!-- Enhanced Mobile Menu Button -->
                    <button class="md:hidden p-3 rounded-xl hover:bg-white/10 transition-all duration-300"
                        id="mobileMenuBtn">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">
            <!-- Enhanced Sidebar -->
            <aside
                class="w-72 bg-white sidebar-shadow flex flex-col transition-all duration-300 ease-in-out border-r border-gray-100"
                id="sidebar">
                @include('admin.nav')

            </aside>

            <div class="container">
                @yield('content')
            </div>


        </div>
    </div>

    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 hidden transition-opacity duration-300"
        id="sidebarOverlay"></div>

    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        mobileMenuBtn.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        });

        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });


        const userDropdown = document.getElementById('userDropdown');
        const userButton = userDropdown.previousElementSibling;

        userButton.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!userButton.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });

        // Enhanced responsive handling
        function handleResize() {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize();

        // Enhanced alert dismissal
        document.querySelectorAll('.fas.fa-times').forEach(button => {
            button.addEventListener('click', function() {
                const alert = this.closest('.mb-8');
                if (alert) {
                    alert.style.transition = 'all 0.3s ease-out';
                    alert.style.transform = 'translateX(100%)';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            });
        });

        // Add smooth scrolling behavior
        document.documentElement.classList.add('smooth-scroll');
    </script>
</body>

</html>
