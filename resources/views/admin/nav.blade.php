   <div class="flex-1 overflow-y-auto smooth-scroll">
       <!-- Enhanced Navigation -->
       <nav class="p-6 space-y-6">
           <!-- Dashboard -->
           <div class="space-y-2">
               <a href="{{ route('admin.dashboard') }}"
                   class="active-nav nav-item flex items-center space-x-4 py-4 px-4 rounded-xl font-semibold text-green-700 shadow-sm">
                   <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                       <i class="fas fa-tachometer-alt text-green-600"></i>
                   </div>
                   <span>Dashboard</span>
               </a>
           </div>

           <!-- Enhanced Section: Laporan -->
           <div class="space-y-3">
               <h4 class="text-gray-400 text-xs font-bold uppercase tracking-wider px-4 flex items-center">
                   <span class="flex-1">Laporan</span>
                   <div class="w-12 h-px bg-gradient-to-r from-gray-300 to-transparent"></div>
               </h4>
               <div class="space-y-1">
                   <a href="{{ route('admin.laporans.index') }}"
                       class="nav-item flex items-center space-x-4 py-3 px-4 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-green-50 hover:to-green-50/50 hover:text-green-700 transition-all duration-200 group">
                       <div
                           class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-red-100 transition-colors duration-200">
                           <i class="fas fa-exclamation-triangle text-gray-600 group-hover:text-red-600"></i>
                       </div>
                       <span class="flex-1">Pengaduan</span>
                       <span class="bg-red-100 text-red-700 text-xs px-2.5 py-1 rounded-full font-semibold">5</span>
                   </a>
               </div>
           </div>

           <!-- Enhanced Section: Kelola Konten -->
           <div class="space-y-3">
               <h4 class="text-gray-400 text-xs font-bold uppercase tracking-wider px-4 flex items-center">
                   <span class="flex-1">Kelola Konten</span>
                   <div class="w-12 h-px bg-gradient-to-r from-gray-300 to-transparent"></div>
               </h4>
               <div class="space-y-1">
                   <a href="{{ route('beritas.index') }}"
                       class="nav-item flex items-center space-x-4 py-3 px-4 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-green-50 hover:to-green-50/50 hover:text-green-700 transition-all duration-200 group">
                       <div
                           class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-200">
                           <i class="fas fa-newspaper text-gray-600 group-hover:text-blue-600"></i>
                       </div>
                       <span>Berita</span>
                   </a>
                   <a href="{{ route('edukasis.index') }}"
                       class="nav-item flex items-center space-x-4 py-3 px-4 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-green-50 hover:to-green-50/50 hover:text-green-700 transition-all duration-200 group">
                       <div
                           class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-purple-100 transition-colors duration-200">
                           <i class="fas fa-graduation-cap text-gray-600 group-hover:text-purple-600"></i>
                       </div>
                       <span>Edukasi</span>
                   </a>
                   <a href="{{ route('visi-misi.index') }}"
                       class="nav-item flex items-center space-x-4 py-3 px-4 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-green-50 hover:to-green-50/50 hover:text-green-700 transition-all duration-200 group">
                       <div
                           class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-green-100 transition-colors duration-200">
                           <i class="fas fa-eye text-gray-600 group-hover:text-green-600"></i>
                       </div>
                       <span>Visi Misi</span>
                   </a>
               </div>
           </div>

           <!-- Enhanced Section: Pengaturan -->
           <div class="space-y-3">
               <h4 class="text-gray-400 text-xs font-bold uppercase tracking-wider px-4 flex items-center">
                   <span class="flex-1">Pengaturan</span>
                   <div class="w-12 h-px bg-gradient-to-r from-gray-300 to-transparent"></div>
               </h4>
               <div class="space-y-1">
                   <a href="{{ route('tims.index') }}"
                       class="nav-item flex items-center space-x-4 py-3 px-4 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-green-50 hover:to-green-50/50 hover:text-green-700 transition-all duration-200 group">
                       <div
                           class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-orange-100 transition-colors duration-200">
                           <i class="fas fa-users text-gray-600 group-hover:text-orange-600"></i>
                       </div>
                       <span>Profil Tim</span>
                   </a>
                   <a href="{{ route('hero.index') }}"
                       class="nav-item flex items-center space-x-4 py-3 px-4 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-green-50 hover:to-green-50/50 hover:text-green-700 transition-all duration-200 group">
                       <div
                           class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-pink-100 transition-colors duration-200">
                           <i class="fas fa-cogs text-gray-600 group-hover:text-pink-600"></i>
                       </div>
                       <span>Sistem</span>
                   </a>
               </div>
           </div>
       </nav>
   </div>
