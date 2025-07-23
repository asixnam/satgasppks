@extends('Frontend.Home.home')

@section('content')

<div class="container mx-auto px-4 py-8 mt-16 text-right">
    <!-- Header Section -->
    <div class="text-center mb-16">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full mb-6 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Pusat <span class="text-orange-500">Edukasi</span>
        </h1>
        <div class="w-24 h-1 bg-gradient-to-r from-orange-400 to-orange-600 mx-auto mb-6"></div>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Tingkatkan pemahaman Anda tentang isu kekerasan seksual, pencegahan, dan dukungan melalui materi edukasi yang komprehensif
        </p>
    </div>

    <!-- Check if there are any education materials -->
    @if($edukasis->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($edukasis as $index => $edukasi)
                @php
                    // Array of colors and categories for variety
                    $colors = [
                        ['from' => 'red-50', 'to' => 'red-100', 'icon' => 'red-500', 'badge' => 'red-500', 'label' => 'PENTING'],
                        ['from' => 'blue-50', 'to' => 'blue-100', 'icon' => 'blue-500', 'badge' => 'blue-500', 'label' => 'PENCEGAHAN'],
                        ['from' => 'green-50', 'to' => 'green-100', 'icon' => 'green-500', 'badge' => 'green-500', 'label' => 'DUKUNGAN'],
                        ['from' => 'purple-50', 'to' => 'purple-100', 'icon' => 'purple-500', 'badge' => 'purple-500', 'label' => 'HUKUM'],
                        ['from' => 'yellow-50', 'to' => 'yellow-100', 'icon' => 'yellow-500', 'badge' => 'yellow-500', 'label' => 'ANAK'],
                        ['from' => 'teal-50', 'to' => 'teal-100', 'icon' => 'teal-500', 'badge' => 'teal-500', 'label' => 'HEALING']
                    ];
                    
                    // Array of icons for variety
                    $icons = [
                        'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z',
                        'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                        'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                        'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3',
                        'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z',
                        'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'
                    ];
                    
                    $colorIndex = $index % count($colors);
                    $iconIndex = $index % count($icons);
                    $currentColor = $colors[$colorIndex];
                    $currentIcon = $icons[$iconIndex];
                @endphp
                
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-orange-200">
                    <div class="relative bg-gradient-to-br from-{{ $currentColor['from'] }} to-{{ $currentColor['to'] }} p-8 flex items-center justify-center h-48">
                        <div class="absolute inset-0 bg-gradient-to-br from-{{ $currentColor['icon'] }}/10 to-{{ $currentColor['icon'] }}/10 group-hover:from-{{ $currentColor['icon'] }}/20 group-hover:to-{{ $currentColor['icon'] }}/20 transition-all duration-500"></div>
                        
                        @if($edukasi->gambar)
                            <!-- Display database image if available -->
                            <div class="relative w-24 h-24 rounded-full overflow-hidden shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-500 border-4 border-white">
                                <img src="{{ asset('storage/' . $edukasi->gambar) }}" 
                                     alt="{{ $edukasi->judul }}" 
                                     class="w-full h-full object-cover">
                            </div>
                        @else
                            <!-- Fallback to icon if no image -->
                            <div class="relative bg-white rounded-full p-6 shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-500">
                                <svg class="w-12 h-12 text-{{ $currentColor['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $currentIcon }}"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <div class="absolute top-4 right-4 bg-{{ $currentColor['badge'] }} text-white px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $currentColor['label'] }}
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors duration-300">
                            {{ $edukasi->judul }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-3">
                            @if($edukasi->konten)
                                {{ Str::limit(strip_tags($edukasi->konten), 150) }}
                            @else
                                Materi edukasi yang penting untuk dipelajari dalam upaya pencegahan dan penanganan kekerasan seksual...
                            @endif
                        </p>
                         <a href="{{ route('detail.edukasi', ['id' => $edukasi->id]) }} class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-700 font-semibold transition-colors duration-300 group/link">
                            Pelajari Lebih Lanjut
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($edukasis->hasPages())
            <div class="mt-12 flex justify-center">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 px-6 py-4">
                    {{ $edukasis->links() }}
                </div>
            </div>
        @endif
    @else
        <!-- Empty state when no education materials -->
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Materi Edukasi</h3>
            <p class="text-gray-600">Materi edukasi sedang dalam proses persiapan. Silakan kembali lagi nanti.</p>
        </div>
    @endif
</div>

<style>
   .px-4 {
    padding-left: 10rem;
    padding-right: 1rem;
    margin-left: auto;
    margin-right: auto;
}

/* Custom pagination styling */
.pagination {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.pagination .page-link {
    padding: 0.5rem 0.75rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    color: #6b7280;
    text-decoration: none;
    transition: all 0.2s;
}

.pagination .page-link:hover {
    background-color: #f3f4f6;
    color: #374151;
}

.pagination .page-item.active .page-link {
    background-color: #f97316;
    border-color: #f97316;
    color: white;
}

.pagination .page-item.disabled .page-link {
    color: #d1d5db;
    cursor: not-allowed;
}

/* Line clamp utility for text truncation */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection