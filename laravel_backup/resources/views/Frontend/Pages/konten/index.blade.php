<div class="max-w-6xl mx-auto px-6">
    <div class="text-center mb-10">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Tata Cara Pelaporan</h2>
        <p class="text-gray-600 mt-2 text-sm md:text-base">
            Ikuti langkah-langkah berikut untuk membuat laporan dengan mudah dan aman
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
        @foreach ($konten as $index => $langkah)
            <div class="flex items-start gap-4">
                <!-- Nomor -->
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-black text-white text-lg font-bold shrink-0">
                    {{ $index + 1 }}
                </div>

                <!-- Isi langkah -->
                <div>
                    <h3 class="font-semibold text-gray-900 text-base">
                        {{ $langkah['judul'] }}
                    </h3>
                    <p class="text-gray-600 text-sm mt-1 leading-relaxed">
                        {{ $langkah['deskripsi'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
