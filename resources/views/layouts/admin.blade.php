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

        /* Dropdown animation classes - TAMBAHKAN INI */
        .dropdown-enter {
            transform: scale(0.95) translateY(-10px);
            opacity: 0;
        }

        .dropdown-show {
            transform: scale(1) translateY(0);
            opacity: 1;
            transition: all 0.2s ease-out;
        }

        .dropdown-hide {
            transform: scale(0.95) translateY(-10px);
            opacity: 0;
            transition: all 0.15s ease-in;
        }

        /* Ensure dropdown is always on top */
        #userDropdown {
            z-index: 9999 !important;
            position: fixed !important;
        }

        /* Header should have high z-index too */
        header {
            z-index: 1000;
            position: relative;
        }
    </style>

    <!-- {{-- Tempat jika halaman ingin menyisipkan style tambahan --}} -->
    @stack('styles')
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
                <div class="w-full overflow-x-auto">
                    @yield('content')
                </div>
            </main>


            <!-- Footer -->
            <footer class="footer-gradient text-white text-center py-4 mt-auto">
                <p class="text-sm">© {{ date('Y') }} SATGAS PPKS UNU Yogyakarta. All rights reserved.</p>
            </footer>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div class="fixed inset-0 hidden duration-300 md:hidden bg-black bg-opacity-50" id="sidebarOverlay"></div>

    <script>
        // Mobile menu functionality
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

        // User dropdown functionality - SCRIPT YANG DIPERBAIKI
        const userButton = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');
        const chevronIcon = document.getElementById('chevronIcon');

        if (userButton && userDropdown) {
            userButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const isHidden = userDropdown.classList.contains('hidden');

                if (isHidden) {
                    // Calculate position dynamically
                    const buttonRect = userButton.getBoundingClientRect();
                    const dropdownWidth = 224; // 56 * 4 = 224px (w-56)

                    // Position dropdown
                    userDropdown.style.position = 'fixed';
                    userDropdown.style.top = (buttonRect.bottom + 8) + 'px';
                    userDropdown.style.right = (window.innerWidth - buttonRect.right) + 'px';
                    userDropdown.style.left = 'auto';
                    userDropdown.style.zIndex = '9999';

                    // Show dropdown
                    userDropdown.classList.remove('hidden');
                    userDropdown.classList.remove('dropdown-hide');
                    userDropdown.classList.add('dropdown-enter');

                    // Trigger animation
                    requestAnimationFrame(() => {
                        userDropdown.classList.remove('dropdown-enter');
                        userDropdown.classList.add('dropdown-show');
                    });

                    // Rotate chevron
                    if (chevronIcon) {
                        chevronIcon.style.transform = 'rotate(180deg)';
                    }
                } else {
                    // Hide dropdown
                    hideDropdown();
                }
            });

            // Function to hide dropdown with animation
            function hideDropdown() {
                userDropdown.classList.remove('dropdown-show');
                userDropdown.classList.add('dropdown-hide');

                // Reset chevron
                if (chevronIcon) {
                    chevronIcon.style.transform = 'rotate(0deg)';
                }

                setTimeout(() => {
                    userDropdown.classList.add('hidden');
                    userDropdown.classList.remove('dropdown-hide');
                    userDropdown.classList.add('dropdown-enter');
                }, 150);
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!userButton.contains(event.target) && !userDropdown.contains(event.target)) {
                    if (!userDropdown.classList.contains('hidden')) {
                        hideDropdown();
                    }
                }
            });

            // Prevent dropdown from closing when clicking inside
            userDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Reposition dropdown on window resize
            window.addEventListener('resize', function() {
                if (!userDropdown.classList.contains('hidden')) {
                    const buttonRect = userButton.getBoundingClientRect();
                    userDropdown.style.top = (buttonRect.bottom + 8) + 'px';
                    userDropdown.style.right = (window.innerWidth - buttonRect.right) + 'px';
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

        // Debug logging
        console.log('Laravel Admin Layout loaded');
        console.log('User dropdown elements:', { userButton, userDropdown, chevronIcon });
    </script>

    <!-- {{-- Tempat halaman menyisipkan JS khusus --}} -->
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
