@extends('Layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-6 lg:py-8 mt-12 sm:mt-16">
    <!-- Back Button -->
    <nav class="flex mb-6 sm:mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3 w-full">
            <li class="inline-flex items-center">
                <a href="/edukasi" class="inline-flex items-center text-xs sm:text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    <span class="hidden xs:inline">Edukasi</span>
                    <span class="xs:hidden">Back</span>
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-4 h-4 sm:w-6 sm:h-6 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 sm:ml-2 text-xs sm:text-sm font-medium text-gray-500 truncate">
                        {{ Str::limit($edukasi->judul, 30) }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header Section -->
    <header class="mb-6 sm:mb-8">
        <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 leading-tight mb-3 sm:mb-4">
            {{ $edukasi->judul }}
        </h1>
        
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 text-gray-600 mb-4 sm:mb-6">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <time datetime="{{ $edukasi->created_at->format('Y-m-d') }}" class="text-xs sm:text-sm">
                    <span class="hidden sm:inline">{{ $edukasi->created_at->format('l, d F Y') }}</span>
                    <span class="sm:hidden">{{ $edukasi->created_at->format('d/m/Y') }}</span>
                </time>
            </div>
            
            @if($edukasi->updated_at != $edukasi->created_at)
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <span class="text-xs sm:text-sm">
                        <span class="hidden sm:inline">Diperbarui: {{ $edukasi->updated_at->format('d F Y') }}</span>
                        <span class="sm:hidden">{{ $edukasi->updated_at->format('d/m/Y') }}</span>
                    </span>
                </div>
            @endif
        </div>
    </header>

    <!-- Image Section -->
    @if($edukasi->gambar)
        <div class="mb-6 sm:mb-8 rounded-xl sm:rounded-2xl overflow-hidden shadow-md sm:shadow-lg">
            <img src="{{ asset('storage/' . $edukasi->gambar) }}" 
                 alt="{{ $edukasi->judul }}"
                 class="w-full h-48 sm:h-64 md:h-80 lg:h-96 object-cover">
        </div>
    @else
        <!-- Default image if no image in database -->
        <div class="text-center mb-8 sm:mb-12">
            <div class="w-full h-48 sm:h-64 md:h-80 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-xl sm:rounded-2xl shadow-lg sm:shadow-2xl flex items-center justify-center">
                <div class="text-center px-4">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 md:w-24 md:h-24 text-purple-400 mx-auto mb-2 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <p class="text-purple-600 font-semibold text-sm sm:text-lg">Materi Edukasi</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content Section -->
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl p-4 sm:p-6 md:p-8 lg:p-12 mb-6 sm:mb-8">
        <div class="prose prose-sm sm:prose-base lg:prose-lg max-w-none">
            <div class="space-y-4 sm:space-y-6 text-gray-700">
                @if($edukasi->konten)
                    <!-- Display content from database -->
                    <div class="formatted-content">
                        {!! nl2br(e($edukasi->konten)) !!}
                    </div>
                @else
                    <!-- Fallback content if no content in database -->
                    <p class="text-base sm:text-lg leading-relaxed">
                        Konten edukasi ini sedang dalam tahap pengembangan. Silakan kembali lagi nanti untuk mendapatkan informasi lengkap mengenai topik ini.
                    </p>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4 justify-center">
                <button onclick="window.print()" class="w-full sm:w-auto bg-purple-600 hover:bg-purple-700 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg font-semibold transition-colors duration-300 inline-flex items-center justify-center shadow-lg text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span class="hidden xs:inline">Cetak Artikel</span>
                    <span class="xs:hidden">Cetak</span>
                </button>
                
                <button onclick="shareArticle()" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg font-semibold transition-colors duration-300 inline-flex items-center justify-center shadow-lg text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                    </svg>
                    Bagikan
                </button>
            </div>
        </div>
    </div>

    <!-- Related Articles Section -->
    @if($relatedEdukasi && $relatedEdukasi->count() > 0)
        <div class="bg-gray-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 shadow-lg">
            <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-800 mb-4 sm:mb-6 text-center">Materi Edukasi Lainnya</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($relatedEdukasi as $related)
                    <a href="{{ route('edukasi.show', $related->id) }}" class="group bg-white rounded-lg sm:rounded-xl p-4 sm:p-6 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 hover:border-purple-300 block">
                        @if($related->gambar)
                            <img src="{{ asset('storage/' . $related->gambar) }}" 
                                 alt="{{ $related->judul }}" 
                                 class="w-full h-24 sm:h-32 object-cover rounded-lg mb-3 sm:mb-4 group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-24 sm:h-32 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-lg mb-3 sm:mb-4 flex items-center justify-center">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        @endif
                        <h4 class="font-semibold text-sm sm:text-base text-gray-800 group-hover:text-purple-600 transition-colors duration-300 line-clamp-2 mb-2">
                            {{ $related->judul }}
                        </h4>
                        <p class="text-xs sm:text-sm text-gray-600 line-clamp-2 mb-3">
                            {{ Str::limit(strip_tags($related->konten), 80) }}
                        </p>
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h4m6 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $related->created_at->format('d M Y') }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Emergency Contact Section -->
    <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-lg sm:rounded-xl p-4 sm:p-6 mt-6 sm:mt-8 shadow-lg">
        <div class="flex items-start sm:items-center mb-3">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-500 mr-2 mt-0.5 sm:mt-0 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <h4 class="text-lg sm:text-xl font-semibold text-red-700">Butuh Bantuan Segera?</h4>
        </div>
        <p class="text-red-800 font-medium mb-4 text-sm sm:text-base leading-relaxed">
            Jika Anda atau seseorang yang Anda kenal mengalami kekerasan seksual, segera cari bantuan profesional. Jangan menunda untuk melaporkan atau mencari dukungan psikologis.
        </p>
        <div class="mb-4">
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('lapor-kekerasan.create') }}" class="w-full sm:w-auto bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg font-semibold transition-all duration-300 inline-flex items-center justify-center shadow-lg hover:shadow-red-500/30 hover:shadow-xl text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    Lapor Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function shareArticle() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $edukasi->judul }}',
            text: 'Baca artikel edukasi: {{ $edukasi->judul }}',
            url: window.location.href
        });
    } else {
        // Fallback untuk browser yang tidak mendukung Web Share API
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(function() {
            alert('Link artikel berhasil disalin ke clipboard!');
        }, function() {
            alert('Gagal menyalin link. Silakan salin manual: ' + url);
        });
    }
}
</script>

<style>
/* Custom responsive breakpoints */
@media (max-width: 475px) {
    .xs\:hidden {
        display: none;
    }
    
    .xs\:inline {
        display: inline;
    }
}

@media (min-width: 476px) {
    .xs\:hidden {
        display: initial;
    }
    
    .xs\:inline {
        display: none;
    }
}

.formatted-content {
    font-size: 0.875rem;
    line-height: 1.5;
}

@media (min-width: 640px) {
    .formatted-content {
        font-size: 1rem;
        line-height: 1.625;
    }
}

@media (min-width: 1024px) {
    .formatted-content {
        font-size: 1.125rem;
        line-height: 1.75;
    }
}

.formatted-content p {
    margin-bottom: 1rem;
}

@media (min-width: 640px) {
    .formatted-content p {
        margin-bottom: 1.5rem;
    }
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Improved mobile touch targets */
@media (max-width: 640px) {
    button, a {
        min-height: 44px;
        min-width: 44px;
    }
}

/* Print styles */
@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        background: white !important;
    }
    
    .shadow-xl, .shadow-lg, .shadow-md {
        box-shadow: none !important;
    }
    
    .bg-gradient-to-r,
    .bg-gradient-to-br {
        background: white !important;
        border: 1px solid #ccc !important;
    }
}

/* Enhanced mobile optimizations */
@media (max-width: 640px) {
    /* Better spacing for mobile */
    .max-w-6xl {
        max-width: 100%;
    }
    
    /* Improved readability on small screens */
    .prose-sm {
        font-size: 0.875rem;
        line-height: 1.5;
    }
    
    /* Better button layout on mobile */
    .flex-col.sm\:flex-row button {
        justify-content: center;
        text-align: center;
    }
}

/* Enhanced tablet optimizations */
@media (min-width: 641px) and (max-width: 1024px) {
    .formatted-content {
        font-size: 1rem;
        line-height: 1.6;
    }
}
</style>
@endsection