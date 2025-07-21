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
            0%, 100% {
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

        /* Fix for scrollable content */
        .main-content {
            height: calc(100vh - 80px); /* Adjust based on header height */
        }

        .sidebar-content {
            height: calc(100vh - 80px);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header -->
    @include('components.admin.header')

    <div class="flex">
        <!-- Sidebar -->
        @include('components.admin.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col main-content">
            <main class="flex-1 p-6 overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="footer-gradient text-white text-center py-4 mt-auto">
                <p class="text-sm">© {{ date('Y') }} SATGAS PPKS UNU Yogyakarta. All rights reserved.</p>
            </footer>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 hidden transition-opacity duration-300 md:hidden" id="sidebarOverlay"></div>

    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (mobileMenuBtn && sidebar && sidebarOverlay) {
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
        }

        const userDropdown = document.getElementById('userDropdown');
        const userButton = userDropdown?.previousElementSibling;

        if (userButton && userDropdown) {
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
        }

        // Enhanced responsive handling
        function handleResize() {
            if (window.innerWidth >= 768) {
                sidebar?.classList.remove('-translate-x-full');
                sidebarOverlay?.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            } else {
                sidebar?.classList.add('-translate-x-full');
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