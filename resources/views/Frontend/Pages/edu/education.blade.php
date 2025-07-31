<div class="container mx-auto px-4">
    <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">Materi Edukasi</h2>

    <div class="flex justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl">
            @foreach ($edukasis as $edukasi)
                <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-xl p-6 card-hover border border-green-200 shadow-sm">
                    <div class="text-center mb-4">
                        @if ($edukasi->gambar)
                            <img src="{{ asset('storage/' . $edukasi->gambar) }}" alt="Gambar Edukasi" class="h-24 w-24 mx-auto object-cover rounded-lg mb-3 shadow">
                        @else
                            <i class="fas fa-book text-4xl text-green-600 mb-3"></i>
                        @endif
                        <h3 class="text-xl font-semibold text-gray-800">{{ $edukasi->judul }}</h3>
                    </div>
                    <a href="{{ route('edukasi.show', ['id' => $edukasi->id]) }}"
                       class="text-green-600 hover:text-green-800 font-medium inline-flex items-center justify-center w-full">
                        Pelajari <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
