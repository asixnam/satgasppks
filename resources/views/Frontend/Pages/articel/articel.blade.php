<div class="container mx-auto px-4">
    <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">Berita Terkini</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($beritas as $berita)
            <article class="bg-white rounded-xl shadow-md overflow-hidden card-hover">

                {{-- Gambar --}}
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}"
                         alt="{{ $berita->judul }}"
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-image text-3xl text-gray-400"></i>
                    </div>
                @endif

                {{-- Konten --}}
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $berita->judul }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($berita->isi), 100) }}
                    </p>
                    <a href="{{ route('berita.show', $berita->id) }}" class="text-green-600 hover:text-green-800 text-sm font-medium inline-flex items-center">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </article>
        @endforeach
    </div>
</div>
