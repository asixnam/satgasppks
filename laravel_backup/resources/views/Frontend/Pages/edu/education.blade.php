<div class="container mx-auto px-4">
    <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-2">
        Materi Edukasi
    </h2>
    <p class="text-center text-gray-600 mb-4">
        Dapatkan informasi terbaru seputar materi edukasi di sini.
    </p>

    <div class="flex justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl w-full">
            @if ($edukasis->count() > 0)
                @foreach ($edukasis as $edukasi)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                        <!-- Header dengan gambar -->
                        <div class="h-48 bg-gradient-to-br from-pink-200 to-pink-300 flex items-center justify-center relative overflow-hidden">
                            @if ($edukasi->gambar)
                                <img src="{{ asset('storage/' . $edukasi->gambar) }}" 
                                     alt="Gambar Edukasi" 
                                     class="w-full h-full object-cover">
                            @else
                                <!-- Default icon jika tidak ada gambar -->
                                <div class="text-white text-6xl opacity-80">
                                    <i class="fas fa-book"></i>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content area -->
                        <div class="p-6 flex flex-col flex-grow">
                            <!-- Category label -->
                            <div class="text-xs text-gray-500 uppercase tracking-wider mb-2 font-medium">
                                BEYOND ADAPTATION
                            </div>
                            
                            <!-- Title -->
                            <h3 class="text-lg font-bold text-gray-800 mb-3 line-clamp-2 leading-tight">
                                {{ $edukasi->judul }}
                            </h3>
                            
                            <!-- Description -->
                            <div class="text-sm text-gray-600 mb-4 flex-grow">
                                @if(isset($edukasi->deskripsi))
                                    <p class="line-clamp-4">{{ $edukasi->deskripsi }}</p>
                                @else
                                    <p class="line-clamp-4">
                                        Pelajari lebih lanjut tentang topik ini melalui materi edukasi yang telah disiapkan khusus untuk Anda.
                                    </p>
                                @endif
                            </div>
                            
                            <!-- Read button -->
                            <div class="mt-auto">
                                <a href="{{ route('edukasi.show', ['id' => $edukasi->id]) }}"
                                   class="inline-block text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors duration-200">
                                    Read
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Pesan jika belum ada edukasi -->
                <div class="col-span-full flex flex-col items-center justify-center text-gray-500 py-20">
                    <i class="fas fa-book-open text-6xl mb-4 text-gray-400"></i>
                    <p class="text-lg font-medium">Belum ada materi edukasi yang tersedia saat ini.</p>
                    <p class="text-sm text-gray-400 mt-1">Silakan cek kembali nanti untuk pembaruan terbaru.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.bg-white:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}
</style>
