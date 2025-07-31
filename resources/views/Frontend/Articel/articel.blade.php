@extends('Layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 mt-16">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                Berita & Artikel
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Informasi terkini seputar isu kekerasan seksual, pencegahan, dan dukungan untuk korban.
            </p>
        </div>

        <div class="space-y-12">
            @forelse ($beritas as $berita)
                <article
                    class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                    <div class="flex flex-col lg:flex-row">
                        <!-- Image Section -->
                        <div class="lg:w-2/5 relative overflow-hidden">
                            <a href="{{ route('berita.show', $berita->id) }}">
                                @if($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}"
                                        alt="{{ $berita->judul }}"
                                        class="w-full h-64 lg:h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <!-- Default image jika tidak ada gambar -->
                                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                        alt="{{ $berita->judul }}"
                                        class="w-full h-64 lg:h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </a>
                        </div>

                        <!-- Content Section -->
                        <div class="lg:w-3/5 p-8 lg:p-10">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    ARTIKEL
                                </span>
                                <span class="text-sm text-gray-500 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $berita->created_at->format('l, d F Y') }}
                                </span>
                            </div>

                            <a href="{{ route('berita.show', $berita->id) }}">
                                <h2
                                    class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 group-hover:text-blue-700 transition-colors duration-300 leading-tight">
                                    {{ $berita->judul }}
                                </h2>
                            </a>

                            <p class="text-gray-700 text-base leading-relaxed mb-6 line-clamp-4">
                                {{ Str::limit(strip_tags($berita->isi), 300, '...') }}
                            </p>

                            <div class="flex items-center justify-between">
                                <a href="{{ route('berita.show', $berita->id) }}"
                                    class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-300 group/link">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        <h3 class="text-2xl font-semibold text-gray-600 mb-2">Belum Ada Berita</h3>
                        <p class="text-lg">Saat ini belum ada berita yang tersedia. Silakan cek kembali nanti.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($beritas->hasPages())
            <div class="flex justify-center mt-16">
                <nav aria-label="Pagination" class="bg-white rounded-xl shadow-lg border border-gray-200 p-2">
                    <div class="flex items-center gap-1">
                        {{-- Previous Page Link --}}
                        @if ($beritas->onFirstPage())
                            <span class="px-4 py-2 text-gray-400 bg-transparent rounded-lg cursor-not-allowed flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Previous
                            </span>
                        @else
                            <a href="{{ $beritas->previousPageUrl() }}" class="px-4 py-2 text-gray-500 bg-transparent hover:bg-gray-100 rounded-lg transition-all duration-300 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Previous
                            </a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($beritas->getUrlRange(1, $beritas->lastPage()) as $page => $url)
                            @if ($page == $beritas->currentPage())
                                <span class="px-4 py-2 text-white bg-blue-600 rounded-lg font-semibold shadow-md">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 text-gray-700 bg-transparent hover:bg-gray-100 rounded-lg transition-all duration-300">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($beritas->hasMorePages())
                            <a href="{{ $beritas->nextPageUrl() }}" class="px-4 py-2 text-gray-500 bg-transparent hover:bg-gray-100 rounded-lg transition-all duration-300 flex items-center gap-2">
                                Next
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @else
                            <span class="px-4 py-2 text-gray-400 bg-transparent rounded-lg cursor-not-allowed flex items-center gap-2">
                                Next
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        @endif
                    </div>
                </nav>
            </div>

            <!-- Pagination Info -->
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">
                    Menampilkan {{ $beritas->firstItem() }} sampai {{ $beritas->lastItem() }} 
                    dari {{ $beritas->total() }} berita
                </p>
            </div>
        @endif
    </div>

    <style>
        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        /* Custom container padding */
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection