@extends('Frontend.Home.home')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 pt-20 pb-12">
    <div class="container mx-auto px-4 py-8">
        
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-full mb-4 shadow-lg">
                <i class="fas fa-search text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                Cek Status Pelaporan
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Masukkan nomor tiket pelaporan Anda untuk melihat status dan perkembangan kasus
            </p>
        </div>

        <!-- Main Content -->
        <div class="max-w-2xl mx-auto">
            
            <!-- Search Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                <form id="statusForm" class="space-y-6">
                    <div>
                        <label for="ticket_number" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-ticket-alt text-primary mr-2"></i>
                            Nomor Tiket Pelaporan
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="ticket_number" 
                                name="ticket_number"
                                placeholder="Contoh: PPKS-2024-001234"
                                class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300 text-lg font-medium"
                                required
                            >
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                <i class="fas fa-hashtag text-gray-400"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Nomor tiket diberikan saat Anda mengirim laporan
                        </p>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-primary to-accent text-white font-bold py-4 px-6 rounded-xl hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300"
                    >
                        <i class="fas fa-search mr-2"></i>
                        Cek Status Sekarang
                    </button>
                </form>
            </div>

            <!-- Status Result (Hidden by default) -->
            <div id="statusResult" class="bg-white rounded-2xl shadow-xl p-8 hidden">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mb-3">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Status Ditemukan</h3>
                </div>

                <!-- Status Timeline -->
                <div class="space-y-4">
                    <div class="flex items-start space-x-4 p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">Laporan Diterima</h4>
                            <p class="text-sm text-gray-600">15 Januari 2024, 14:30 WIB</p>
                            <p class="text-sm text-gray-500 mt-1">Laporan Anda telah diterima dan sedang dalam proses verifikasi</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-eye text-white text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">Sedang Ditinjau</h4>
                            <p class="text-sm text-gray-600">16 Januari 2024, 09:15 WIB</p>
                            <p class="text-sm text-gray-500 mt-1">Tim SATGAS PPKS sedang meninjau dan memverifikasi laporan Anda</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg border-l-4 border-gray-300">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-gray-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">Menunggu Tindak Lanjut</h4>
                            <p class="text-sm text-gray-600">Status Selanjutnya</p>
                            <p class="text-sm text-gray-500 mt-1">Proses investigasi dan tindak lanjut akan segera dimulai</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="mt-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-800">Perlu Bantuan?</h4>
                            <p class="text-sm text-gray-600 mt-1">
                                Jika Anda memiliki pertanyaan atau perlu informasi lebih lanjut, silakan hubungi kami di:
                            </p>
                            <div class="mt-2 space-y-1">
                                <p class="text-sm"><i class="fas fa-phone mr-2 text-yellow-600"></i> 085156900844</p>
                                <p class="text-sm"><i class="fas fa-envelope mr-2 text-yellow-600"></i> satgasppks@unu-jogja.ac.id</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Result (Hidden by default) -->
            <div id="errorResult" class="bg-white rounded-2xl shadow-xl p-8 hidden">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                        <i class="fas fa-times-circle text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Nomor Tiket Tidak Ditemukan</h3>
                    <p class="text-gray-600 mb-6">
                        Mohon periksa kembali nomor tiket yang Anda masukkan. Pastikan format dan angka sudah benar.
                    </p>
                    
                    <div class="space-y-4 text-left">
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">
                                <i class="fas fa-lightbulb text-blue-600 mr-2"></i>
                                Tips Pencarian:
                            </h4>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• Pastikan format nomor tiket benar (contoh: PPKS-2024-001234)</li>
                                <li>• Periksa email konfirmasi yang dikirim saat Anda membuat laporan</li>
                                <li>• Nomor tiket bersifat case-sensitive</li>
                            </ul>
                        </div>
                        
                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">
                                <i class="fas fa-question-circle text-green-600 mr-2"></i>
                                Belum Punya Nomor Tiket?
                            </h4>
                            <p class="text-sm text-gray-600 mb-3">
                                Jika Anda belum melaporkan kasus, silakan buat laporan terlebih dahulu.
                            </p>
                            <a href="/lapor" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                                <i class="fas fa-plus mr-2"></i>
                                Buat Laporan Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Cards -->
            <div class="grid md:grid-cols-2 gap-6 mt-8">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-blue-600"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Waktu Respons</h3>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Tim SATGAS PPKS akan merespons laporan Anda dalam waktu maksimal 2x24 jam pada hari kerja.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-shield-alt text-green-600"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Kerahasiaan</h3>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Identitas pelapor dan informasi kasus dijamin kerahasiaannya sesuai dengan prosedur yang berlaku.
                    </p>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-8">
                <a href="/" class="inline-flex items-center text-primary hover:text-accent transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('statusForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const ticketNumber = document.getElementById('ticket_number').value.trim();
    const statusResult = document.getElementById('statusResult');
    const errorResult = document.getElementById('errorResult');
    
    // Hide both results first
    statusResult.classList.add('hidden');
    errorResult.classList.add('hidden');
    
    // Simple validation for demo - in real app, this would be an API call
    if (ticketNumber.match(/^PPKS-\d{4}-\d{6}$/)) {
        // Show success result
        setTimeout(() => {
            statusResult.classList.remove('hidden');
            statusResult.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 500);
    } else {
        // Show error result
        setTimeout(() => {
            errorResult.classList.remove('hidden');
            errorResult.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 500);
    }
});

// Format input while typing
document.getElementById('ticket_number').addEventListener('input', function(e) {
    let value = e.target.value.toUpperCase();
    
    // Remove any non-alphanumeric characters except hyphens
    value = value.replace(/[^A-Z0-9-]/g, '');
    
    // Auto-format to PPKS-YYYY-XXXXXX pattern
    if (value.length > 4 && !value.includes('-')) {
        if (value.startsWith('PPKS')) {
            value = value.slice(0, 4) + '-' + value.slice(4);
        }
    }
    if (value.length > 9 && value.split('-').length === 2) {
        const parts = value.split('-');
        if (parts[1].length > 4) {
            value = parts[0] + '-' + parts[1].slice(0, 4) + '-' + parts[1].slice(4);
        }
    }
    
    e.target.value = value;
});
</script>

<style>
    .px-4 {
    padding-left: 6rem;
    padding-right: 1rem;
}

@media (min-width: 1024px) {
    .container {
        max-width: 100%;
    }
}
</style>


@endsection
